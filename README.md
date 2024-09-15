# zero
Zero dependency frameworks

## Rant

Really it should not be required to pull in 9000 files just to show a webpage.  Even for large complex apps.
Unused code is code that will break one day.  The maintainer will get bored and shut it down.  The company gets bought or goes in a new direction.  A security issue is discovered.
Each dependency introduces a new future possibility of an upgrade, security or patch cycle into your code base.  One that you are not in control of.
Software rots faster with each dependency.
Yet code from the 80's still hapily runs in many huge companies.  Do you want your code to last 10 years, 20 years or 10 months?

The engineering mantra - the best part is no part.  Is true of software.  Yet only in software do we pull in huge libraries with huge surface areas only to use 1 function. I know, I have been there.  It is tempting.
But, the best code is no code.

With AI in the loop now - it is likely faster to simply learn the specifics and code what you need - than to pull in another library.  It's better for debugging. It's better for code size, and it's better for your own learning.  This might have been totally infeasible in the past because there is a week lag on learning the specifics of an area you are not familliar, say image handling, or bluetooth, or binary manipulation.  But now this is an AI request away.  You can rapidly fill the blanks that would have taken many painful weeks, and therefore reach for a library.  Now - you can stay focused on writing and integrating just the code you need.

I see this with modern development, most of the task is fighting with frameworks, with dependencies, with local test setups.  Rather than the joy of tight dev cycles.

The idea for this framework is you copy the whole thing.  Then pop your code inside.
And good for educating what things are really doing.


Interesting demos:
-------------------
MVC basics
Autoloading: 1 function

Future possibility:
PHP: Node.js EventLoop - for websockets and non blocking behaviour in PHP.



Zero MVC
--------

/your-project
│
├── /App
│   ├── /Global
│   │   ├── /Controllers
│   │   ├── /Models
│   │   └── /Views
│   └── /TenantSpecific
│       ├── /Tenant1
│       │   ├── /Controllers
│       │   ├── /Models
│       │   └── /Views
│       └── /Tenant2
│           ├── /Controllers
│           ├── /Models
│           └── /Views
├── /Zero
|   └── /Mvc
│       ├── App.php
│       ├── Controller.php
│       └── Model.php
├── autoload.php
└── index.php
