<?php
// ***CUSTOM SIGNATURE FILE

// *php 5 fix
global $whyblockout, $ax;

// *Place your custom signatures below this line.


// *Place your custom signatures above this line.
//(Do not forget to report them at http://zaphodb777.dyndns.org/forum if they prove useful!)

// *Mini-Documentation
//
// The Signature format is...
//
//  $ax = $ax + ([type of match]([variable to be searched],"[pattern]","[what is the reason for the check]"));
//
//  or (minmatch only)
//
//  $ax = $ax + (minmatch([variable to be searched],"[pattern]",[decimal allowed occuence limit],"[what is the reason for the check]"));
//
//
//  [type of match] can be:
//
//  lmatch:   Check for a match at the left side of the variable only. (Good for Singular IPs)
//  rmatch:   Check for a match at the right side of the variable only. (Good for hostnames)
//  inmatch:  Check for a match anywhere in the variable to be searched.
//  minmatch: Check for a match anywhere in the variable to be searches, and see if it occurs more often than the limit.
//
//  [variable to be searched] should be:
//
//  $address     : The IP address of the client.
//  $hoster      : The Hostname of the client.
//  $query       : The lowercased query of the URL used. (use for non-case sensitive matches)
//  $querydec    : The lowercased and decoded query of the URL received. (removes %## for clear detections)
//  $query2      : The raw query of the URL used. (use for case sensitive matches)
//  $loaded      : File that was loaded on your machine, lowercased.
//  $fromhost    : Referrer.
//  $pathinfo    : Binary T/F as to whether the client sent a path in the URL.
//
//  [pattern] what part of the URL sent to your machine is indicitave of an attack?
//
//  [decimal allowed occuence limit] Times searched string may occur without a triggering.
//
//  [what is the reason for the check] Give explanation of why if found this block acts.
//
//
// Special IP range match.
//
//  $ax = $ax + (iprange($address,"[low ip]","[high ip]","[host/reason]"));
//
//  [low ip]  : Classic quadot (www.xxx.yyy.zzz) beginning of range IP address. 
//
//  [high ip] : Classic quadot (www.xxx.yyy.zzz) end of range IP address.
//
//  [host/reason] what is blocked by range, and why.
//
//  OR use CIDR ranges like this.
//
//  $ax = $ax + (cidrblock($address,"[CIDR range]","[host/reason]"));
//
//  As before, except...
//
//  [CIDR range] : Quadot with a /bitmask. (www.xxx.yyy.zzz/bitmask)
//
//
// Remove above comments to line "// *Mini-Documentation" for a very small speed boost.

// *Test Trigger to test function. (Errors will abort processing before here)

$ax = $ax + (inmatch($query,"ctestc","Test Trigger to test function"));

?>