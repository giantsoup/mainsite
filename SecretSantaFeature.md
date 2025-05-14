# Secret Santa Feature Documentation

## Models

### Event
- **Attributes**:
  - `name`: Name of the event
  - `date`: Date of the event
  - `is_active`: Boolean indicating if this is the active event
  - `has_pairings`: Boolean indicating if pairings have been generated
- **Relationships**:
  - `participants`: Many-to-many relationship with Participant
  - `matches`: One-to-many relationship with EventMatch
- **Scopes**:
  - `active`: Filter for active events

### Participant
- **Attributes**:
  - `first_name`: First name of the participant
  - `last_name`: Last name of the participant
  - `email`: Email address of the participant
  - `phone`: Phone number of the participant
- **Computed Attributes**:
  - `name`: Concatenation of first and last name
  - `formatted_phone`: Formatted phone number
- **Relationships**:
  - `events`: Many-to-many relationship with Event
  - `exclusions`: One-to-many relationship with Exclusion
  - `links`: One-to-many relationship with Link
  - `eventMatches`: One-to-many relationship with EventMatch
- **Methods**:
  - `activeEvent()`: Get the active event for this participant

### Exclusion
- **Attributes**:
  - `participant_id`: ID of the participant
  - `excluded_participant_id`: ID of the participant they cannot be paired with
- **Relationships**:
  - `participant`: Belongs to Participant
  - `excludedParticipant`: Belongs to Participant (as excluded)

### EventMatch
- **Attributes**:
  - `event_id`: ID of the event
  - `participant_id`: ID of the participant who is giving a gift
  - `matched_participant_id`: ID of the participant who is receiving a gift
- **Relationships**:
  - `event`: Belongs to Event
  - `participant`: Belongs to Participant (giver)
  - `matchedParticipant`: Belongs to Participant (receiver)

## Routes

### Public Routes
- `GET /secret-santa`: Display the current active Secret Santa event
  - Controller: `EventController@currentEvent`
  - Name: `events.currentEvent`

### Private Routes (Authenticated)
- `GET /events/{event}/runLottery`: Run the lottery to generate pairings
  - Controller: `EventController@runLottery`
  - Name: `events.runLottery`
- `GET /events/{event}/rerunLottery`: Delete existing pairings and run the lottery again
  - Controller: `EventController@rerunLottery`
  - Name: `events.rerunLottery`
- Resource routes for events, participants, exclusions, and links

## Views

### SecretSanta.vue
- Main public view for the Secret Santa event
- Displays:
  - Event name and date
  - List of participants
  - Login/dashboard links based on authentication status
- Props:
  - `canLogin`: Whether login links should be shown
  - `event`: The current Secret Santa event
  - `participants`: The list of participants in the event
  - `currentYear`: The current year (for copyright)

### Participant.vue
- Component for displaying a single participant
- Displays:
  - Name (always shown)
  - Email and phone (shown conditionally)
  - Links (shown/hidden with a toggle button)
- Props:
  - `participant`: The participant object
  - `showPhoneAndEmail`: Whether to show email and phone

## Pairing Generation Logic

The Secret Santa pairing algorithm is implemented in `EventController@runLottery`:

1. Get all participants for the event
2. Get the previous 3 events
3. For each participant:
   - Get their exclusions
   - Get their previous matches from the last 3 events
   - Find available participants who:
     - Are not the participant themselves
     - Are not in their exclusion list
     - Have not been matched with them in the previous 3 events
     - Have not already been matched in this lottery
   - Randomly select one available participant as their match
   - If no available participants, log an error
4. Update the event to indicate it has pairings

Key constraints in the pairing algorithm:
- Participants cannot be paired with themselves
- Participants cannot be paired with anyone in their exclusion list
- Participants cannot be paired with the same person they were paired with in the previous 3 events
- Each participant can only be selected as a match once per event

The `rerunLottery` method deletes all existing matches for an event and runs the lottery again.
