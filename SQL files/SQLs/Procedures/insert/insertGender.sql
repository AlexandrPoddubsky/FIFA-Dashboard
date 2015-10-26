create or replace procedure insertGenderCat ( pGender varchar2)
as
       BEGIN
         insert into genderCatalog (genderID,gender)
         values(genderID_seq.nextval,pGender);

        Exception
         WHEN INVALID_NUMBER THEN
              DBMS_OUTPUT.PUT_LINE ('Gender ID error ');
         WHEN OTHERS THEN
              DBMS_OUTPUT.PUT_LINE ('Unexpected error');
              RAISE;
         commit;

       END;
