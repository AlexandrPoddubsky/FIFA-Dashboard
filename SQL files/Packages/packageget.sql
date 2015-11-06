create or replace package get is
-------------------------------------------------------------------------------
procedure TeamID (pTeamName varchar2, pTeamID  out number);

procedure Clubs ( pClub  out sys_refcursor);

procedure Selections ( pSelection  out sys_refcursor);

procedure playerbyselection (pSelectionID in number, pPlayerID out sys_refcursor);

procedure stadiumID (pStadiumID  out number);

procedure TDID (pTdID  out number);
 
procedure teams ( pTeams  out sys_refcursor);
 
-------------------------------------------------------------------------------
END get;
