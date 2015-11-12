create or replace package get is
-------------------------------------------------------------------------------
procedure TeamID (pTeamName varchar2, pTeamID  out number);

procedure Clubs ( pClub  out sys_refcursor);

procedure Selections ( pSelection  out sys_refcursor);

procedure playerbyselection (pSelectionID in number, pPlayerID out sys_refcursor);

procedure stadiumID (pStadiumID  out number);

procedure TDID (pTdID  out number);
 
procedure teams ( pTeams  out sys_refcursor);

procedure PlayersByTeam (pTeamID in number, pPlayerbyTeams  out sys_refcursor);

procedure team ( pteamID number, pTeam  out sys_refcursor);

procedure Player (pDNI varchar2, pPlayer  out sys_refcursor);

procedure Players ( pPlayers  out sys_refcursor);

procedure getevents ( pEvents  out sys_refcursor);

procedure eventTeam (peventID number, pEvents  out sys_refcursor);

procedure gamesByEvent (pEventID in number, pGameID out sys_refcursor);

procedure TeamsBygame (pID in varchar2, pteamsbygame out sys_refcursor);

procedure games ( pgames out sys_refcursor);

procedure EventID ( peventID  out number);

procedure goalsByGame ( pGameID  in varchar2, pTeamID in number, pGoals out number);

-------------------------------------------------------------------------------
procedure statisticsbygroupteam ( pteamID  in varchar2, peventid in number,
                                  pteamName out varchar2, pflag out varchar2,
                                  pmp out number);
procedure matchesPlayed ( pteamID  in number, pgameid in varchar2,
                                  pMatches out sys_refcursor) ;



END get;
