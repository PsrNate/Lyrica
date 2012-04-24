Lyrica
======

A Touhou-specialized social network ! This project mainly aims at
centralizing replays and scores so as to create rankings. It should
therefore contain some advanced social functions such as messaging, comparing
or sending matches replays - considering, for instance, Phantasmagoria games.
There will be player rankings based on Elo indicators as well.

But what's Touhou anyway ?

> The Touhou Project (東方Project) is a series of 2D (with 3D background)
vertically-scrolling danmaku shooting games made by Team Shanghai Alice, with
three fighting game spinoffs co-produced with Tasogare Frontier. They are
similar to regular shooting games, but focus more on weaving through complex
patterns containing anywhere from dozens to hundreds of bullets. Every game in
the Touhou series is set in the fantasy land of Gensokyo, and the series is
known for its huge cast of characters, well-developed storylines, and related
materials such as music CDs, fan-made comics and animated videos made to the
music.

Nicely written and comprehensive definition, taken from
[Touhou Project Wiki](http://touhou.wikia.com/wiki/Touhou_Wiki). 
As of today the project started a few months ago and I'm still in the first
steps of figuring out how the website's general outline should be. Lyrica
is probably going to be written in French - even though it will be developed
and commented in English; but translating it to English, Japanese and other
languages is obviously planned on a longer time scale.

1. Why Lyrica ?
---------------

The answer is pretty simple. :) It all actually started under
the name Touhou PRS (Power Ranking System) as a website where you could
vote for your favorite characters, inspired from
[Facemash](http://en.wikipedia.org/wiki/History_of_Facebook#Facemash).
And exactly as you may think, the main idea was to write something less
disastrous than Seimoe. :V

Where was I ? Oh right, PRS...Which made me think of a quite familiar name :
Prismriver. Then I had a choice between the three sisters and that's pretty
much how everything came down to "Lyrica". It probably isn't more than a
codename, since the domain name isn't available, but for the time being this
is how I will be referring to the project. Deal with it.

2. Bundles
----------

As you may have noticed, Lyrica is powered by [Symfony](http://symfony.com),
which means that its source code will be divided in bundles :

> A bundle is similar to a plugin in other software, but even better. The key
difference is that everything is a bundle in Symfony2, including both the core
framework functionality and the code written for your application. Bundles are
first-class citizens in Symfony2. This gives you the flexibility to use
pre-built features packaged in third-party bundles or to distribute your own
bundles. It makes it easy to pick and choose which features to enable in your
application and to optimize them the way you want.

Pretty concise and straightforward definition from
[The Book](http://symfony.com/doc/current/book/index.html), Symfony's
main document. Let's move on to the bundles that should be part of Lyrica's
source code.

### Aya

This bundle is meant to store a news feed, fully embedded with comments, tags,
research functions and much more things one would normally expect from a blog.
As such, I had a choice between Aya and Hatate as reporters, and I went for Aya.
Don't ask me why. :)

### Eirin

This bundle should consist in what PRS did, namely hosting a popularity
contest between characters, based on 1-vs-1 matchups and ELO indicators.
I thought of the idea as Characters Power Ranking, that is to say CPR...And
that's how I came up with Touhou's nurse, Eirin.

### Reimu

This bundle will act like a main gate for the website ; and yes, when you
think of a main gate, you come up with the idea of a shrine, and thus its
maiden. And no, I didn't choose Reimu because she's one of mai waifus. Well,
not entirely... Meh. Whatever.

### Satori

This is actually a User bundle, which will manage permissions, settings, and
everything related. I'll use 
[FOSUserBundle](https://github.com/FriendsOfSymfony/FOSUserBundle) as a base
to work with. And the reason why I went for Satori is simply because she's a
landlady, that is to say someone that manages the place and
[keeps everything in place](http://www.youtube.com/watch?v=J26HxhLNNu4).
Not to mention that she's indecently cute. :V

***

Of course there will be more to come, but as only Eirin's code has already been
written in flat PHP, migrating it to Symfony2 will be the first objective
before we move on to the main social features and player rankings.
Stay tuned !