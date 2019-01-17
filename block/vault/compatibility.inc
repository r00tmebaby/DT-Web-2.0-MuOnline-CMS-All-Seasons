<?php
// COMPATIBILITY LAYER FILE
// ISSUE 3
// COMPATIBLE WITH ZB Block 0.4.5
// FROM HTTP://WWW.SPAMBOTSECURITY.COM
// COPYRIGHT 2008,2009,2010 GNU/GPL V.2 BY MIKE H.

// php 5.x fix
global $whyblockout, $ax, $zbregcheck;

// This file is used as a "drop-in" module for ZB Block so certian softwares can
// be used with it. It activates and deactivates certain functions depending on
// known incompatibilities with the basic phpBB3 profile.
//
// Although the first half of this file can be edited by hand, that is only
// recommended with custom packages. If you know about a compatibility issue,
// it is far better to alert the project, so a new compatibilty layer file can
// be made.
//
// The Second half of this file (or so), is for site specific bypassing, and may
// need editing.
//
// The basic distributed file should work with most packages, while leaving it
// in place would be easiest, it offers the least amount of security.

/// *** Pathing detection.
// If your site uses URLs with "friendly names" such as...
// http://www.yoursite.tld/Musings_Upon_The_Torture_of_Spammers
//
// MAY BE REQURED FOR WORDPRESS AND JOOMLA
//
// instead of "classic" filenames like...
// http://www.yoursite.tld/?article=Musings_Upon_The_Death_of_Spammers
// or
// http://www.yoursite.tld/viewtopic?f=7&t=21
//
// You should leave these off. Elswise, remove commenting, as in remove the
// "// " (turn on) for more security.

//$ax = $ax + ($pathinfo); if ($pathinfo) { $whyblockout = $whyblockout . "Site does NOT use server path_info. " ; }
//$ax = $ax + (inmatch($requesturi,".php//","Errant path attempting a remote file include"));

/// *** VBulletin Fixes
// This should be turned off (commented //) for anything but VB

// Sloppy Big Querys
$ax = $ax - (minmatch($querydec,"name=",1,"Nesting attack"));

/// *** Specific bypass for wordpress login
// This should remain commented unless you are running wordpress.

//if (inmatch($whyblockout,"RFI (http)","")){
//$temp = "redirect_to=http://" . $thishost ;
//$ax = $ax - (inmatch($querydec,$temp,""));
//$ax = $ax + (minmatch($querydec,"=http:",1,"RFI (http)"));
//}


/// *** Site calls itself in query.
// If you have any urls that look like this,
// http://www.yoursite.tld/page1.php?next=http://www.yoursite.tld/page2.php
// uncomment the below. Can be very dangerous and open the door to RFI. Consider
// getting better software that pases this data through POST.
//
// NOTE: IF YOU USE THIS, DEACTIVATE THE ABOVE WORDPRESS LOGIN FUNCTION
// (It would become redundant, and open the door to RFI)

if (inmatch($whyblockout,"RFI (http)","")){
$temp = "http://" . $thishost ;
$ax = $ax - (inmatch($querydec,$temp,""));
$ax = $ax + (minmatch($querydec,"=http:",1,"RFI (http)"));
}


/// *** Directory Traversal / Tree-Climbing
// If site uses multiple (back)directories, comment these out (risky),
// or add 1 more "../" and "..%5C" than you need (preferred).

$ax = $ax + (inmatch($requesturi,"../../","Directory traversal attack"));
$ax = $ax + (inmatch($requesturi,"../..%5C","Directory traversal attack"));
$ax = $ax + (inmatch($requesturi,"..%5C../","Directory traversal attack"));
$ax = $ax + (inmatch($requesturi,"..%5C..%5C","Directory traversal attack"));


/// *** Illegal URL Format
// As above comment out if it causes problems (risky),
// or add one more slash than you need (preferred).

//$ax = $ax + (inmatch($requesturi,"///","Illegal URL format"));


/// *** Registration / Login Check Bypasses
// Some of the remote databases list 192.168.x.x or 127.0.0.1 as hostile. Other
// times your own host may be listed as hostile, or you might have to pass a
// friend beyond the normal 
// This can break your ability to log-in to whatever script on your server if
// you access in local mode, or by LAN. (this one bit the author! [127.0.0.1])
// Leave these commented if you don't need them.

if ($zbregcheck){
if ($address == "127.0.0.1"){$zbregcheck = 0;}
if ($address == gethostbyname($thishost)){$zbregcheck = 0;} //ON for Wordpress
if (lmatch($address,"192.168.","")){$zbregcheck = 0;}
//if (lmatch($address,"www.xxx.yyy.zzz","")){$zbregcheck = 0;}
//if (lmatch($address,"www.xxx.yyy.zzz","")){$zbregcheck = 0;}
//if (lmatch($address,"www.xxx.yyy.zzz","")){$zbregcheck = 0;}
//if (lmatch($address,"www.xxx.yyy.zzz","")){$zbregcheck = 0;}
//if (rmatch($hoster,"something.tld","")){$zbregcheck = 0;}
//if (rmatch($hoster,"something.tld","")){$zbregcheck = 0;}
//if (rmatch($hoster,"something.tld","")){$zbregcheck = 0;}
//if (rmatch($hoster,"something.tld","")){$zbregcheck = 0;}
}


// *** File Function Test
$ax = $ax + (inmatch($query,"cltestcl",'Test Trigger to test compatibility layer function'));

?>