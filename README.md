# Wizard Technical Services

A simple application for demonstration purposes.

It should give anyone doing a code review some idea of how I would go about
getting stuff done.  Its not meant to serve any other function.  If you like
it and find it useful, enjoy, with my blessings and hopes for your success.

Is it complete?  Nope.  Not supposed to be, its a demo of me, not it.

Is it bug free?  Nope.

If you find bugs, well, here's your warning:
```
 "I never promised you a rose garden" 
   -- song written by Joe South, and sung by Lynn Anderson
```

Someday, I might get around to refactoring, fixing -- then again -- maybe not.


Regards,\
[Wizard](https://wiztechsvcs.com)


# Bootstrap, Laravel, and PostgreSQL

I have extensive experience with PHP and PostgreSQL and wanted to demonstrate
using a modern framework.


# Theological Debates

There are things in here which set off some folks OCD, are perceived as a
"disturbance in the force", or causes them severe theological headaches.

If you find yourself typing up gentle instruction, annoyed reminders, or,
flaming descriptions of the depravity, of which, you believe I am guilty,
rest assured -- I did it on purpose, by design -- just to offend YOU!

Right?  Nope.  Its just a demonstration, remember?

```
  "Many of the truths we cling to, depend greatly, on our own point of view"
    -- Obi-Wan Kenobi
```

Clearly, should you ever choose to work with me at some point, I can and
will, do it your way, or, march to my own music, when necessary.


# RESTful APIs

In addition to the WEB front end, there are APIs for some things.

Use your favorite [Postman](https://www.getpostman.com), [Insomnia](https://insomnia.rest),
or plain old **curl** for testing.

* Using **curl** [api-tests.sh](api-tests.sh)
  * note: I have node's "json" installed locally
* yes, I am aware that passing api_token in the URL is nasty
  * if you REALLY want me to fix it, HIRE ME!

I am using *Laravel's* concept of *Resources* to control format and return of the data.

In an effort to somewhat adhere to DRY principles, I chose the "single controller" method.
If this offends you in some way, see the above, [Theological Debates](#theological-debates).

Yes, I am aware there is still far too much duplication!


# Installation/Configuration and testing

After extracting/pulling (or whatever you method you use) to get this into some
directory of choice, I recommend running:
```bash
composer update
```

I will assume (yes, I know what that makes US), you know how to configure the
basics of what should be in your *.env* file.

I used (the default?) [MailTrap](https://mailtrap.io) functionality to test
sending/receiving emails.

If you want to change where the Contact email will be sent, you can, by
setting variables in your *.env* file:
```bash
#
# this overrides Laravel defaults
MAIL_FROM_ADDRESS="website@example.com"
MAIL_FROM_NAME="WebsiteContact"
#
# added this one to control where new contacts are sent
MAIL_CONTACTSTO="salesfolks@example.com"
```


## Testing with phpunit

Testing, in general, sets off [Theological Debates](#theological-debates).

I only put enough in here to test the basics and demostrate their use.

I presume, for my integration tests, you have created both the production and
testing databases.  The tests available through *phpunit* use database transactions
on the test database.  If all the tests perform as expected, the test database will
contain nothing.

* look here for more info, and make changes to suit yourself:
  * [makethedb.sh](database/makethedb.sh)
  * [phpunit.xml](phpunit.xml)

The test require not only the database itself, but, the migrations (all the tables).
For myself, I made a temporary change to the *.env* file to reference the test
database and then ran:

```bash
php artisan migrate:fresh
```

Once you switch back to production in your *.env* file, if you want the database
to contain the seed values:

```bash
php artisan migrate:fresh --seed
```

After successfully generating the databases, and you have edited your *phpunit.xml*
to reflect your choices, you can then run:

```bash
phpunit
```

I usually modify my environment PATH variable to include *"vendor/bin"*.  If the
above *phpunit* does not work, try prefixing like so:

```bash
./vendor/bin/phpunit
```


# Credit where Credit is Due

Others perspiration has served as some of my ongoing inspiration!

I would like to give a shout out to some of those I have been watching/reading.

* [Jeffrey Way](https://laracasts.com/series?curated)
* [Brad Traversy](http://www.traversymedia.com)
* [Andre Castelo](https://www.toptal.com)

