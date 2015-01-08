use boliche2014;

insert into teams_participants (participant_id, team_id)
select id as participant_id, (select id from teams where name = 'generic') as team_id from participants limit 25
