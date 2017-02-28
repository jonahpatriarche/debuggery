# Welcome to the Debuggery!

This project was designed to build my portfolio a bit, and to start experimenting with VueJS and Bulma. I will probably convert it into a Laravel package when it's ready to be released into the world. <br>

Project design started Feb 26th, 2017 and is ongoing

## The Concept 
Have you ever found yourself thinking "I've seen this error before! How the hell did I fix it?" I certainly have. Do you find standard stack traces and error log files a pain to sift through? Yes. Me too. I decided to combine a human-readable error logging tool (Buggers) with my obsessive record-keeping tendencies (Trackers).

### Buggers ###
The user will be able to go to a /buggers route and see a nice, human-readable summary of errors logged during their development efforts. This will display a nice list of error logs, which will be filterable by the log level (error, warning, info, etc). Use cases:
* Click 'x' to delete a log entry
* Click the log (or a button or something) to see more details
* From details, you have the option to dismiss the log or start a tracker entry

### Trackers ###
Trackers are essentially a list of steps you took to try to fix the bug along with the original error log and some other useful info about your bug-fixing effort. From a particular log entry, you create a new tracker with a form with:
* name
* checklist of standard bug-fixing steps from my standard workflow (things like dumping autoload, clearing caches, updating composer, etc)
* optional screenshot upload
* optional input for configuration variables

When you try a new fix, you make a quick entry in your tracker with: 
* description of the step. ex: "Checked MySQL was running"
* links to any docs or web articles you consulted (ex: stack overflow)
* optional screenshot upload
* checkmark to indicate if the step fixed the issue
* [down the road] dropdown list to select an error log that was caused by your fix

***

## Hooray! You fixed the Bug! Is that it? ##
### No! ###
After you've marked a Tracker as 'resolved', it is archived. Whenever any new errors are logged, Debuggery will search through the resolved trackers to see if you've solved a similar problem and link to any trackers that might help you figure out what's going on.

***

## So Where's the Project At? ##
### Buggers ###
* Wrote the custom exception logger and migrations to record error logs to DB
* Implemented Model, Controller, Repositories, and Transformers
* Controller returns transformed Bugger data to a basic Blade template view that is styled with Bootstrap

#### Tangent! ####
* Reimplemented a new controller to behave as a backend API that sends JSON data to the front-end
* reimplemented view to use VueJS, and styled it with Bulma

### Trackers ###
* migration and Controllers
