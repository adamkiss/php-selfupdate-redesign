# Redesign project

This is just something I'm playing with — live redesign stuff. It's totally dirty (as in: real mess, hacked together and debugged via million git commits and `var_dump()`). Oh well.

Note: Checkboxes in readme don't change the note behind in list. Oh well.

## TODO

- selfupdate.php
  + ~~Clean it up~~
  + ~~Make it ignore itself (too lazy to do selfupdate selfupdate)~~
    * ~~Test PHP script rewriting itself? (NO PROBLEM)~~
    * Obviously, PHP has no problem with rewriting running script. Hm.
  + ~~Make it (somewhat) safe by ignoring `..` and `.` (it's in root anyway)~~
  + Make it recognize '--cache-clear'
- hookdebug.php
  + remove this (it shouldn't be needed once self update is done)
- Update README with notes how any of this works (because I played with this 5 days ago and I already forgot most of it)
- Project itself
  + set up Gulp (ha!)
  + Write down usage with live + ngrok
  + Be nice
    * Add robots noindex nofollow
    * Remove any tracking code (don't mess up statistics)
  + Change links
  + Add caching
  + Play away

## How it should work

1. Edit CSS/JS/Images
1. View it locally
1. Be okay with it
1. Commit
1. It updates, so show off

## Chaos here:
- debugging
- I'm an idiot?