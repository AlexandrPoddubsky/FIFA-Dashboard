Comment on table actionbyplayerbygame
is 'This is a table for action by player by game.';
Comment on column actionbyplayerbygame.actionid
is 'Identify action and primary key';
Comment on column actionbyplayerbygame.playerbygameid
is 'Identify player by game and foreign key';
Comment on column actionbyplayerbygame.actiontime
is 'ActionTime';

---------------------------------------------------------

Comment on table Actioncatalog
is 'This is a table for action catalog.';
Comment on column actioncatalog.actionid
is 'Identify action and primary key';
Comment on column actioncatalog.actionname
is 'Action Time';

---------------------------------------------------------

Comment on table citycatalog
is 'This is a table for city catalog.';
Comment on column citycatalog.cityid
is 'Identify city and primary key';
Comment on column citycatalog.cityname
is 'City name';
Comment on column citycatalog.countryid
is 'Identify country and foreign key';

---------------------------------------------------------

Comment on table continentcatalog
is 'This is a table for continent catalog.';
Comment on column continentcatalog.continentid
is 'Identify continent and primary key';
Comment on column continentcatalog.continentname
is 'Continent name';

---------------------------------------------------------

Comment on table countrycatalog
is 'This is a table for country catalog.';
Comment on column countrycatalog.countryid
is 'Identify country and primary key';
Comment on column countrycatalog.countryname
is 'Country name';
Comment on column countrycatalog.continentid
is 'Identify continent and foreign key';

---------------------------------------------------------

Comment on table event
is 'This is a table for event.';
Comment on column event.eventid
is 'Identify event and primary key';
Comment on column event.eventdescription
is 'Describes the event';
Comment on column event.startdate
is 'Event start date';
Comment on column event.enddate
is 'Event end date';
Comment on column event.maxteams
is 'Event maxt teams';
Comment on column event.countryid
is 'Event identify country';
Comment on column event.eventname
is 'Event name'

---------------------------------------------------------

Comment on table game
is 'This is a table for game.';
Comment on column game.team1id
is 'Team 1';
Comment on column game.team2id
is 'Team 2';
Comment on column game.stadiumid
is 'Identify stadium and foreign key';
--Comment on column game.gamedate
--is 'Game date time';
--omment on column game.eventid
--is 'Identify event id, is primary key and foreign key';
--Comment on column game.bracketpos
--is 'Identify position in the backet, is primary and foreign key';
--Comment on column game.hours
--is 'Game hourin the event';
--Comment on column game.minutes
--is 'Game minute in the event';
---------------------------------------------------------

Comment on table groupcatalog
is 'This is a table for group catalog.';
Comment on column groupcatalog.groupid
is 'Identify group and primary key';
Comment on column groupcatalog.groupname
is 'Group name';

---------------------------------------------------------

Comment on table lineupbyteam
is 'This is a table for line up by team.';
Comment on column lineupbyteam.teamid
is 'Identify team and primary key';
Comment on column lineupbyteam.lineupid
is 'Identify line up and primary key';

---------------------------------------------------------

Comment on table Lineupcatalog
is 'This is a table for line up catalog.';
Comment on column lineupcatalog.lineupid
is 'Identify line up and primary key';
Comment on column lineupcatalog.goalkeeper
is 'Goal keeper';
Comment on column lineupcatalog.defender
is 'Defender';
Comment on column lineupcatalog.midfield
is 'Midfield';
Comment on column lineupcatalog.lineforward
is 'Line forward';
---------------------------------------------------------
Comment on table logbook
is 'This is a table that register the triggers.';
Comment on column logbook.logbookid
is 'Identify logbook and is primary key';
Comment on column logbook.userconected
is 'Identify user connected';
Comment on column logbook.schedule
is 'Identify the schedule';
Comment on column logbook.date_time
is 'Identify date time';
Comment on column logbook.tablename
is 'Identify table';
Comment on column logbook.action
is 'Identify action';
Comment on column logbook.descrip
is 'Description of action';

---------------------------------------------------------

Comment on table player
is 'This is a table for player.';
Comment on column player.dni
is 'Identify player and primary key';
Comment on column player.firstname
is 'Playe first name';
Comment on column player.lastname1
is 'Player last name1';
Comment on column player.lastname2
is 'Player last name2';
Comment on column player.clubtshirt
is 'Club tshirt number';
Comment on column player.selectiontshirt
is 'Selection tshirt number';
Comment on column player.picture
is 'Player picture';
Comment on column player.clubcaptain
is 'Identify if is captain in tha club';
Comment on column player.selectioncaptain
is 'Identify if is captain in tha selection';
Comment on column player.countryid
is 'Identify the country';
---------------------------------------------------------

Comment on table playerbygame
is 'This is a table for player by game.';
Comment on column playerbygame.playerbygameid
is 'Identify player by game and primary key';
Comment on column playerbygame.dni
is 'Identify player and foreign key';
Comment on column playerbygame.gameid
is 'Identify game and foreign key';

---------------------------------------------------------

Comment on table playerbyteam
is 'This is a table for player by team.';
Comment on column playerbyteam.playerdni
is 'Identify player by game and foreign key';
Comment on column playerbyteam.teamid
is 'Identify team and foreign key';

---------------------------------------------------------

Comment on table playerbytype
is 'This is a table for player by type.';
Comment on column playerbytype.playerdni
is 'Identify player by type and foreign key';
Comment on column playerbytype.playertypeid
is 'Identify type and foreign key';

---------------------------------------------------------

Comment on table stadiumcatalog
is 'This is a table for stadium catalog.';
Comment on column stadiumcatalog.stadiumid
is 'Identify stadium and primary key';
Comment on column stadiumcatalog.stadiumname
is 'Stadium name';
Comment on column stadiumcatalog.googlemapsid
is 'Stadium google maps ID';
Comment on column stadiumcatalog.picture
is 'Stadium picture';
Comment on column stadiumcatalog.capacity
is 'Stadium capaciy';
Comment on column stadiumcatalog.cityid
is 'Stadium city';

---------------------------------------------------------

Comment on table statisticbygroup
is 'This is a table for statistic by group.';
Comment on column statisticbygroup.groupid
is 'Identify group and foreign key';
Comment on column statisticbygroup.statisticid
is 'Identify statistic and foreign key';

---------------------------------------------------------

Comment on table Tdcatalog
is 'This is a table for tecnical director.';
Comment on column tdcatalog.tdid
is 'Identify tecnical director and primary key';
Comment on column tdcatalog.tdfirstname
is 'Tecnical director first name';
Comment on column tdcatalog.tdlastname1
is 'Tecnical director last name1';
Comment on column tdcatalog.tdlastname2
is 'Tecnical director last name2';
Comment on column tdcatalog.tdcounrtyid
is 'Tecnical director country';
Comment on column tdcatalog.tdpicture
is 'Tecnical director picture';

---------------------------------------------------------

Comment on table team
is 'This is a table for team.';
Comment on column team.teamid
is 'Identify team and primary key';
Comment on column team.teamname
is 'Team name';
Comment on column team.captainid
is 'Team captain id';
Comment on column team.flagpath
is 'Team flagpath';
Comment on column team.logopath
is 'Team logopath';
Comment on column team.cityid
is 'Team city';
Comment on column team.tdid
is 'Identify tecnical director and foreign key';
Comment on column team.teamtypeid
is 'Identify team type and foreign key';

---------------------------------------------------------

Comment on table teambyevent
is 'This is a table for team by event.';
Comment on column teambyevent.teamid
is 'Identify team and foreign key';
Comment on column teambyevent.eventid
is 'Identify event and foreign key';

---------------------------------------------------------

Comment on table teamtypecatalog
is 'This is a table for team type catalog.';
Comment on column teamtypecatalog.teamtypeid
is 'Identify team type and primary key';
Comment on column teamtypecatalog.teamtypename
is 'Team type name';

---------------------------------------------------------

Comment on table tstatistic
is 'This is a table for statistic.';
Comment on column tstatistic.statisticid
is 'Identify statistic and primary key';
Comment on column tstatistic.played
is 'Identify played';
Comment on column tstatistic.won
is 'Identify won';
Comment on column tstatistic.draw
is 'Identify draw';
Comment on column tstatistic.lost
is 'Identify lost';
Comment on column tstatistic.goalsfor
is 'Identify goalsfor';
Comment on column tstatistic.goalsagainst
is 'Identify goals against';
Comment on column tstatistic.goalsdifference
is 'Identify goals difference';
Comment on column tstatistic.fairplaypoints
is 'Identify fairplay points';

---------------------------------------------------------

Comment on table typeplayercatalog
is 'This is a table for type player catalog.';
Comment on column typeplayercatalog.playertypeid
is 'Identify team type player and primary key';
Comment on column typeplayercatalog.playertypename
is 'Player type name';

---------------------------------------------------------

Comment on table useradmin
is 'This is a table for user administrator.';
Comment on column useradmin.userid
is 'Identify user administrator and primary key';
Comment on column useradmin.useremail
is 'User administrator email, and is unique';
Comment on column useradmin.usernamepassword
is 'User administrator password';

---------------------------------------------------------


