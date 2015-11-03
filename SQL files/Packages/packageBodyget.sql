CREATE OR REPLACE PACKAGE BODY get AS
-------------------------------------------------------------------------------

-------------------------------------------------------------------------------

-------------------------------------------------------------------------------
procedure TeamID (pTeamName varchar2, pTeamID  out number) as
 -- Gets all team  that ptype and return the names in the sys_refcursor.
       BEGIN
         
         select max(t.teamid) into pTeamID
         from team t;
         --where t.teamtypeid = ptype
         
         
         Exception
         WHEN NO_DATA_FOUND THEN
              DBMS_OUTPUT.PUT_LINE ('TeamID no found:');
       END;
-------------------------------------------------------------------------------
procedure Clubs ( pClub  out sys_refcursor) as
 -- Gets all team  that pClub and return the ids and names in the sys_refcursor.
       BEGIN
         
        open pClub for
         select t.teamid as typeNameID, t.teamname as typeName
         from team t
         where t.teamtypeid = 2
         order by typeName;
         Exception
         WHEN NO_DATA_FOUND THEN
              DBMS_OUTPUT.PUT_LINE ('Catalog no found:');
       END;
-------------------------------------------------------------------------------
procedure Selections ( pSelection  out sys_refcursor) as
 -- Gets all team  that pSelection and return the ids and names in the sys_refcursor.
       BEGIN
         
        open pSelection for
         select t.teamid as typeNameID, t.teamname as typeName
         from team t
         where t.teamtypeid = 1
         order by typeName;
         Exception
         WHEN NO_DATA_FOUND THEN
              DBMS_OUTPUT.PUT_LINE ('Catalog no found:');
       END;
-------------------------------------------------------------------------------

       
-------------------------------------------------------------------------------
   
END get;
