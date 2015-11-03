create or replace package get is
-------------------------------------------------------------------------------
procedure TeamID (pTeamName varchar2, pTeamID  out number);
procedure Clubs ( pClub  out sys_refcursor);
procedure Selections ( pSelection  out sys_refcursor);

-------------------------------------------------------------------------------
END get;
