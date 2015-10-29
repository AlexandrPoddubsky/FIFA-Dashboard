CREATE OR REPLACE PACKAGE BODY getCatalog AS
-------------------------------------------------------------------------------

-------------------------------------------------------------------------------

procedure Country (pCountryCatalog  out sys_refcursor) as
 -- Gets all types of Country and return the names in the sys_refcursor.
       BEGIN
         open pCountryCatalog for
         select COUNTRYID as typeNameID, COUNTRYNAME as typeName
         from countryCatalog
         order by typeName;
         Exception
         WHEN NO_DATA_FOUND THEN
              DBMS_OUTPUT.PUT_LINE ('Catalog no found:');
       END;
-------------------------------------------------------------------------------

-------------------------------------------------------------------------------
procedure City (pCountryID in varchar2, pcityCatalog  out sys_refcursor) as
 -- Gets all types of City and return the names in the sys_refcursor.
       BEGIN
         open pcityCatalog for
         select cityID as typeNameID, cityName as typeName
         from cityCatalog
         where Citycatalog.Countryid = pCountryID
         order by typeName;
         Exception
         WHEN NO_DATA_FOUND THEN
              DBMS_OUTPUT.PUT_LINE ('Catalog no found:');
       END;
-------------------------------------------------------------------------------
procedure typeTeam (ptype number, pTypeTeam  out sys_refcursor) as
 -- Gets all team  that ptype and return the names in the sys_refcursor.
       BEGIN
         open pTypeTeam for
         select t.teamname as typeName
         from team t
         where t.teamtypeid = ptype
         order by typeName;
         
         Exception
         WHEN NO_DATA_FOUND THEN
              DBMS_OUTPUT.PUT_LINE ('Catalog no found:');
       END;
-------------------------------------------------------------------------------
-------------------------------------------------------------------------------

       
-------------------------------------------------------------------------------
   
END getCatalog;
