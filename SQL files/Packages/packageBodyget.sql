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
-------------------------------------------------------------------------------

       
-------------------------------------------------------------------------------
   
END get;
