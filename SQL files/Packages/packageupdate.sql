create or replace package updates is

procedure flag (pTeamID number, pflagpath varchar2);

procedure logo (pTeamID number, pLogoPath varchar2);

procedure picture (pPlayerID number, pPicture varchar2);

END updates;
