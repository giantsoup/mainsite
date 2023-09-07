# Secret Santa
This is an app to allow an organizer to setup and manage a Secret Santa event. The app will contain the names of the participants and links to their Amazon wish lists or direct links to products. The app will track year to year who was matched so you dont get repeats and will allow the organizer to exclude certain people from being matched e.g. a husband and wife would never get matched to each other.

## Database
### User
- id
- email
- password
- first_name
- last_name
- created_at
- updated_at

### Participant
- id
- first_name
- last_name

### Exclusion
- participant_id
- excluded_participant_id

### Link
- id
- event_participant_id
- url

### Event
- id
- name
- active
- created_at
- updated_at
- deleted_at

### Event Participant
- event_id
- participant_id

### Event Match
- event_id
- participant_id
- participant_match_id

## Screens
In general there will be a sidebar menu and top bar menu for users when logged in.

The top bar menu will be:
- App Name (far left)
- Logout (far right)

The sidebar menu will be:
- Events
- Participants

### /login
The login page. If someone tries to hit the homepage and isnt logged in they will be redirected here.

### /
Homepage after user has logged in. Shows a list of active events.

### /participants
Lists all Participants. Each Participant can be clicked on, which will drop down their details e.g. links to each event they have been put in and all their exclusions. A User will be able to update a Participant's exclusions from here.

### /event/name-of-event
Shows a single Event. This is a public page viewable by Users and non-users. A non-user will be able to see the names of all Participants and that Participant's links. A User will be able to see all that plus who each Participant is matched with. A User will be able to add links for each Participant.
