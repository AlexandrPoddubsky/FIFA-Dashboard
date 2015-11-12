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
procedure Continent (pcontinentcatalog out sys_refcursor) as
 -- Gets all types of Country and return the names in the sys_refcursor.
       BEGIN
         open pcontinentcatalog for
         select c.continentid as typeNameID, c.continentname as typeName
         from continentcatalog c
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
procedure action (pActionCatalog  out sys_refcursor) as
 -- Gets all team  that ptype and return the names in the sys_refcursor.
       BEGIN
         open pActionCatalog for
         select a.actionid as typeNameID, a.actionname as typeName  
         from actioncatalog a
         order by typeName;
         
         Exception
         WHEN NO_DATA_FOUND THEN
              DBMS_OUTPUT.PUT_LINE ('Catalog no found:');
       END;
-------------------------------------------------------------------------------
-------------------------------------------------------------------------------
-------------------------------------------------------------------------------
procedure lineUp (pLineupCatalog  out sys_refcursor) as
 -- Gets all team  that ptype and return the names in the sys_refcursor.
       BEGIN
         open pLineupCatalog for
         select l.lineupid as typeNameID,
                l.goalkeeper as typegoalkeeper,
                l.defender as typedefender,
                l.midfield as typemidfield,
                l.lineforward as typelineforward
         from lineupcatalog l
         order by typeNameID;
         
         Exception
         WHEN NO_DATA_FOUND THEN
              DBMS_OUTPUT.PUT_LINE ('Catalog no found:');
       END;

-------------------------------------------------------------------------------
procedure stadium (pStadiumCatalog  out sys_refcursor) as
 -- Gets all team  that ptype and return the names in the sys_refcursor.
       BEGIN
         open pStadiumCatalog for
         select s.stadiumid as typeNameID,
                s.stadiumname as typeName,
                s.googlemapsid as typegooglemapsid,
                s.picture as typepicture,
                s.capacity as typecapacity,
                s.cityid as typecity
         from stadiumcatalog s
         order by typeName;
         
         Exception
         WHEN NO_DATA_FOUND THEN
              DBMS_OUTPUT.PUT_LINE ('Catalog no found:');
       END;
       
-------------------------------------------------------------------------------
procedure TDCatalog (pTDCatalog  out sys_refcursor) as
 -- Gets all team  that ptype and return the names in the sys_refcursor.
       BEGIN
         open pTDCatalog for
         select t.tdid as typeNameID,
                t.tdfirstname||' ' ||t.tdlastname1||' ' ||t.tdlastname2 as typeName,
                t.tdcounrtyid as typecountry,
                t.tdpicture as typepicture 
         from tdcatalog t
         order by typeName;
         
         Exception
         WHEN NO_DATA_FOUND THEN
              DBMS_OUTPUT.PUT_LINE ('Catalog no found:');
       END;
       
-------------------------------------------------------------------------------
procedure teamType (pTeamTypeCatalog  out sys_refcursor) as
 -- Gets all team  that ptype and return the names in the sys_refcursor.
       BEGIN
         open pTeamTypeCatalog for
         select t.teamtypeid as typeNameID, t.teamtypename as typeName  
         from teamtypecatalog t
         order by typeName;
         
         Exception
         WHEN NO_DATA_FOUND THEN
              DBMS_OUTPUT.PUT_LINE ('Catalog no found:');
       END;
-------------------------------------------------------------------------------
procedure TypePlayer (pTypePlayerCatalog  out sys_refcursor) as
 -- Gets all team  that ptype and return the names in the sys_refcursor.
       BEGIN
         open pTypePlayerCatalog for
         select tp.playertypeid as typeNameID, tp.playertypename as typeName  
         from typePlayerCatalog tp
         order by typeName;
         
         Exception
         WHEN NO_DATA_FOUND THEN
              DBMS_OUTPUT.PUT_LINE ('Catalog no found:');
       END;
-------------------------------------------------------------------------------


   
END getCatalog;
