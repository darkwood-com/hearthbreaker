Symfony Standard Edition
========================

Intro
-----

Hearthbreaker is an extra simple web server based on Apache, Symfony2 and twitter-bootstap.
It is an helper for the famous game [Hearthstone](http://eu.battle.net/hearthstone)
It scrapp cards and decks stats (win rate) from various website sources. Use it as below

1) You scrapp cards and deck by launching the command line :

    app/console hb:scrapper 
    
2) You register a new local account (or connected to the default one - login : admin@example.com, password : admin)
3) You check all card you own
4) Then you can search and filter among deck. It will find decks that you could potentially build with an high win rate.


Install
-------

add in your /etc/hosts

    10.1.1.52 heartbreaker.dev.dev

then (install virtual-box dans vagrant)
    
    $ vagrant up

that's it !
