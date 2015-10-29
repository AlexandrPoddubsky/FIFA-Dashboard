create or replace package inserts is
-------------------------------------------------------------------------------

procedure userAdministrator ( pUserEmail varchar2, pusernamepassword varchar2);
procedure event ( pdescription varchar2, pstartdate date,penddate date, pmaxteams number, pcountry number);
procedure team ( pteamName varchar2, pCaptainID number, pflagpath varchar2, plogopath varchar2,pcityid number,
               ptdid number, pteamtypeid number);
               
procedure player ( pDNI varchar2, pFirstName varchar2, pLastName1 varchar2, pLastName2 varchar2, pClubTshirt number,
               pSelectionTshirt number, pPicture varchar2, pCaptain char);

-------------------------------------------------------------------------------
END inserts;
