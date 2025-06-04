# Secret Santa

Web app for easy organization of Secret Santa events.

In the file `private/people.csv` you can add the people who will participate in the event. It is inaccesible from the browser, so you can safely store sensitive information like email addresses or phone numbers.

Then in `people.php` you can set the seed for the randomization of the Secret Santa pairs. As such, the pairs will always be deterministic.
