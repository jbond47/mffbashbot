<?php
// Dynamic JavaScript for Harry's My Free Farm Bash Bot (front end)
// Copyright 2016-18 Harun "Harry" Basalamah
// some parts shamelessly stolen and adapted from
// http://www.mredkj.com/tutorials/tutorial005.html
// quoting Keith Jenci: "Code marked as public domain is without copyright, and can be used without restriction."
// and
// https://developer.mozilla.org/en/docs/Web/API/notification
// quoting MDM: "Code samples added on or after August 20, 2010 are in the public domain. No licensing notice is necessary, but if you need one, you can [...]"
// :)
//
// This program is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// This program is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with this program.  If not, see <http://www.gnu.org/licenses/>.

echo <<<EOT
<script type="text/javascript">

function sanityCheck(elSel, elSelDest, amountpos) {
 if (elSel.options[elSel.selectedIndex].value == "sleep" && amountpos > 0) {
  alert("{$strings['nonsense']}");
  return false;
 }
 if (elSel.options[elSel.selectedIndex].value != "sleep" && amountpos < 1) {
  alert("{$strings['missingamount']}");
  return false;
 }
 if (elSel.id == "itemposmonsterfruit") {
  if (elSel.selectedIndex >= 1 && elSel.selectedIndex <= 7 && !(elSelDest.id == "qselmonsterfruit3")) {
   alert("{$strings['wrongqueue']}");
   return false;
  }
  if (elSel.selectedIndex >= 8 && elSel.selectedIndex <= 14 && !(elSelDest.id == "qselmonsterfruit2")) {
   alert("{$strings['wrongqueue']}");
   return false;
  }
  if (elSel.selectedIndex >= 15 && !(elSelDest.id == "qselmonsterfruit1")) {
   alert("{$strings['wrongqueue']}");
   return false;
  }
 }
 return true;
}

function insertOptionBefore(elSel, elSelDest, amountpos)
{
 if (!sanityCheck(elSel, elSelDest, amountpos))
  return false;
 if (elSel.selectedIndex >= 0) {
  var elOptNew = document.createElement('option');
  if (amountpos > 0) {
   elOptNew.text = amountpos + " " + elSel.options[elSel.selectedIndex].text;
   elOptNew.value = elSel.options[elSel.selectedIndex].value + "," + amountpos;
  } else {
   elOptNew.text = elSel.options[elSel.selectedIndex].text;
   elOptNew.value = elSel.options[elSel.selectedIndex].value;
  }
  var elOptOld = elSelDest.options[elSelDest.selectedIndex];
  try {
   elSelDest.add(elOptNew, elOptOld); // standards compliant; doesn't work in IE
   return false;
  }
  catch(ex) {
   elSelDest.add(elOptNew, elSel.selectedIndex); // IE only
   return false;
  }
 }
}

function appendOptionLast(elSel, elSelDest, amountpos)
{
 if (!sanityCheck(elSel, elSelDest, amountpos))
  return false;
 var elOptNew = document.createElement('option');
 if (amountpos > 0) {
  elOptNew.text = amountpos + " " + elSel.options[elSel.selectedIndex].text;
  elOptNew.value = elSel.options[elSel.selectedIndex].value + "," + amountpos;
 } else {
  elOptNew.text = elSel.options[elSel.selectedIndex].text;
  elOptNew.value = elSel.options[elSel.selectedIndex].value;
 }
 try {
  elSelDest.add(elOptNew, null); // standards compliant; doesn't work in IE
  return false;
 }
 catch(ex) {
  elSelDest.add(elOptNew); // IE only
  return false;
 }
}

function removeOptionSelected(elSelDest)
{
 for (var i = elSelDest.length - 1; i>=0; i--) {
  if (elSelDest.options[i].selected) {
   elSelDest.remove(i);
  }
 }
 return false;
}

function updateBotStatus() {
 var sUser = document.venueselect.username.value;
 var sData = "username=" + sUser + "&action=getbotstatus";
 xhttp = new XMLHttpRequest();
 xhttp.onreadystatechange = function() {
  if (xhttp.readyState == 4 && xhttp.status == 200)
   document.getElementById("botstatus").innerHTML = xhttp.responseText;
 }
 xhttp.open("POST", "botaction.php", true);
 xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
 xhttp.send(sData);

 sData = "username=" + sUser + "&action=getlastruntime";
 xhttp2 = new XMLHttpRequest();
 xhttp2.onreadystatechange = function() {
  if (xhttp2.readyState == 4 && xhttp.status == 200)
   document.getElementById("lastruntime").innerHTML = xhttp2.responseText;
 }
 xhttp2.open("POST", "botaction.php", true);
 xhttp2.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
 xhttp2.send(sData);
 
 window.setTimeout(updateBotStatus, 30000);
}

function saveMisc() {
 var i, v;
 var aOptions = ['lottoggle', 'vehiclemgmt5', 'vehiclemgmt6', 'carefood',
 'caretoy', 'careplushy', 'freegardenspeedupfarm', 'startvetroledifficulty'];
 var aToggles = ['puzzlepartstoggle', 'farmiestoggle', 'forestryfarmiestoggle',
 'munchiestoggle', 'flowerfarmiestoggle', 'correctqueuenumtoggle',
 'ponyenergybartoggle', 'redeempuzzlepartstoggle', 'butterflytoggle',
 'deliveryeventtoggle', 'megafieldplanttoggle', 'olympiaeventtoggle',
 'redeemdailyseedboxtoggle', 'dogtoggle', 'donkeytoggle', 'startpetbreedingtoggle'];
 var sUser = document.venueselect.username.value;
 var sData = "username=" + sUser + "&farm=savemisc";
// abusing farm parameter :)
 for (i = 0; i < aOptions.length; i++) {
  v = document.getElementById(aOptions[i]);
  sData += "&" + aOptions[i] + "=" + v.options[v.selectedIndex].value;
 }
 for (i = 0; i < aToggles.length; i++) {
  document.getElementById(aToggles[i]).checked ? sData += "&" + aToggles[i] + "=1" : sData += "&" + aToggles[i] + "=0";
 }
 AJAXsave(sData);
 return false;
}

function saveConfig() {
 var sUser = document.venueselect.username.value;
 var sFarm = document.venueselect.farm.value;
 var sData = "username=" + sUser + "&farm=" + sFarm + "&queueContent=";

 switch (sFarm) {
  case "forestry":
  case "farmersmarket":
  case "foodworld":
  case "city2":
   if (sFarm == "farmersmarket")
    var fmpos = ["flowerarea", "nursery", "monsterfruit", "pets", "vet"];
   if (sFarm == "forestry")
    var fmpos = ["sawmill", "carpentry", "forestry"];
   if (sFarm == "foodworld")
    var fmpos = ["sodastall", "snackbooth", "pastryshop", "icecreamparlour"];
   if (sFarm == "city2")
    var fmpos = ["windmill", "trans25", "trans26", "powerups", "tools"];

   for (k = 0; k <= (fmpos.length - 1); k++) {
    var i = fmpos[k];
    sData += document.getElementById("queue" + i)[0].value + " "; // queue file name
    sData += document.getElementById("queue" + i)[1].value + " "; // building type
    for (j = 0; j < document.getElementById("queue" + i)[2].options.length; j++)
     sData += document.getElementById("queue" + i)[2][j].value + " "; // fill with queue items
    if (document.getElementById("queue" + i)[3] !== undefined) { // do we have a second queue?
     sData = sData.substring(0, sData.length - 1);
     sData += "-"; // mark the 2nd queue
     sData += document.getElementById("queue" + i)[3].value + " ";
     sData += document.getElementById("queue" + i)[4].value + " ";
     for (j = 0; j < document.getElementById("queue" + i)[5].options.length; j++)
      sData += document.getElementById("queue" + i)[5][j].value + " ";
    }
    if (document.getElementById("queue" + i)[6] !== undefined) { // do we have a third queue?
     sData = sData.substring(0, sData.length - 1);
     sData += "-"; // mark the 3rd queue
     sData += document.getElementById("queue" + i)[6].value + " ";
     sData += document.getElementById("queue" + i)[7].value + " ";
     for (j = 0; j < document.getElementById("queue" + i)[8].options.length; j++)
      sData += document.getElementById("queue" + i)[8][j].value + " ";
    }
    sData = sData.substring(0, sData.length - 1);
    sData += "#"; // replace last space
   }
  break;

  default:
   for (i = 1; i <= 6; i++) {
    sData += document.getElementById("queue" + i)[0].value + " ";
    sData += document.getElementById("queue" + i)[1].value + " ";
    for (j = 0; j < document.getElementById("queue" + i)[2].options.length; j++)
     sData += document.getElementById("queue" + i)[2][j].value + " ";
    if (document.getElementById("queue" + i)[3] !== undefined) {
     sData = sData.substring(0, sData.length - 1);
     sData += "-";
     sData += document.getElementById("queue" + i)[3].value + " ";
     sData += document.getElementById("queue" + i)[4].value + " ";
     for (j = 0; j < document.getElementById("queue" + i)[5].options.length; j++)
      sData += document.getElementById("queue" + i)[5][j].value + " ";
    }
    if (document.getElementById("queue" + i)[6] !== undefined) {
     sData = sData.substring(0, sData.length - 1);
     sData += "-";
     sData += document.getElementById("queue" + i)[6].value + " ";
     sData += document.getElementById("queue" + i)[7].value + " ";
     for (j = 0; j < document.getElementById("queue" + i)[8].options.length; j++)
      sData += document.getElementById("queue" + i)[8][j].value + " ";
    }
    sData = sData.substring(0, sData.length - 1);
    sData += "#";
   }
 }
// strip last char
 sData = sData.substring(0, sData.length - 1);
// save data via AJAX
 AJAXsave(sData);
 return false;
}

function displayNotification(sTitle, sBody, bConfirm, sTag) {
 var options = { icon: 'image/mffbot.png',
                body: sBody,
                requireInteraction: bConfirm,
                tag: sTag };
 if (!("Notification" in window))
  alert(sTitle);
 else if (Notification.permission === "granted")
  var notification = new Notification(sTitle, options);
 else if (Notification.permission !== "denied") {
  Notification.requestPermission(function (permission) {
 if (permission === "granted")
  var notification = new Notification(sTitle, options);
  });
 }
}

function showHideOptions() {
 var div = document.getElementById("optionspane");
 if (div.style.display !== "none") {
  div.style.display = "none";
  return false;
  }
 else {
  div.style.display = "inline-block";
  return false
  }
}

function confirmUpdate() {
 var cu = confirm("{$strings['confirmupdate']}");
 if (cu == true) {
  var sData = "username=" + document.venueselect.username.value + "&action=triggerupdate";
  xhttp = new XMLHttpRequest();
  xhttp.open("POST", "botaction.php", true);
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhttp.send(sData);
  window.setTimeout(showCountdown, 250, 15);
  return false;
  }
 else
  return false;
}

function showCountdown(counter) {
 if (counter <= 0)
  window.location.href="/mffbashbot";
 else {
  document.getElementById("updatenotification").innerHTML = "Countdown: " + counter + " ";
  window.setTimeout(showCountdown, 1000, --counter);
 }
}

function AJAXsave(sData) {
 xhttp = new XMLHttpRequest();
 xhttp.onreadystatechange = function() {
 if (xhttp.readyState == 4 && xhttp.status == 200)
  if (xhttp.responseText == 0)
   displayNotification("{$strings['saveOK']}", "", false, "saveOK");
  else
   displayNotification("{$strings['error']}", "{$strings['saveNOK']}", true, "saveNOK");
 }
 xhttp.open("POST", "save.php", false);
 xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
 xhttp.send(sData);
}
</script>

EOT;
?>
