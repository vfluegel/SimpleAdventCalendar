# Simple Advent Calendar
A simple PHP advent calendar for photos.

## Usage
Build the docker image for the container with:  
``docker build -t adventcalendar --build-arg NAME=<some username> --build-arg PASS=<some password> .``

Then start it with:  
``docker run -d --rm --name adventcalendar2024 -p 80:80 adventcalendar``

The website is now running and prompts a login to enter. Use the previously created user here.
