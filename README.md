# Redesign project

This is just something I'm playing with — live redesign stuff. It's totally dirty (as in: real mess, hacked together and debugged via million git commits and `var_dump()`). Also, testing checkboxes in markdown on github. Oh well.

## TODO

- [ ] selfupdate.php
  + [ ] Clean it up
  + [ ] Make it ignore itself (too lazy to do selfupdate selfupdate)
    * [ ] Test PHP script rewriting itself?
  + [ ] Make it (somewhat) safe by ignoring `..` and `.` (it's in root anyway)
- [ ] hookdebug.php
  + [ ] remove this (it shouldn't be needed once self update is done)
- [ ] Update README with notes how any of this works (because I played with this 5 days ago and I already forgot most of it)
- [ ] Project itself
  + [ ] set up Gulp (ha!)
  + [ ] Be nice
    * [ ] Add robots noindex nofollow
    * [ ] Remove any tracking code (don't mess up statistics)
  + [ ] Change links
  + [ ] Add caching
  + [ ] Play away