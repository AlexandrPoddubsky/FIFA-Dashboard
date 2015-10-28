CREATE OR REPLACE PACKAGE BODY inserts AS
-------------------------------------------------------------------------------

procedure userAdministrator ( pUserEmail varchar2, pusernamepassword varchar2)
as
       BEGIN
         insert into useradmin (userID,useremail,usernamepassword)
         values(adminID_seq.NextVal,pUserEmail,pusernamepassword);

        Exception
         WHEN VALUE_ERROR THEN
              DBMS_OUTPUT.PUT_LINE ('Insert error ');
         WHEN OTHERS THEN
              DBMS_OUTPUT.PUT_LINE ('Unexpected error');
              RAISE;
         commit;

       END;
       
-------------------------------------------------------------------------------
procedure event ( pdescription varchar2, pstartdate date,penddate date, pmaxteams number, pcountry number)
as
       BEGIN
         insert into event (eventID,eventdescription,startdate,enddate,maxteams,countryID)
         values(eventID_seq.NextVal,pdescription,pstartdate,penddate,pmaxteams,pcountry);

        Exception
         WHEN VALUE_ERROR THEN
              DBMS_OUTPUT.PUT_LINE ('Insert event error ');
         WHEN OTHERS THEN
              DBMS_OUTPUT.PUT_LINE ('Unexpected error');
              RAISE;
         commit;

       END;
       
-------------------------------------------------------------------------------
   
END inserts;
