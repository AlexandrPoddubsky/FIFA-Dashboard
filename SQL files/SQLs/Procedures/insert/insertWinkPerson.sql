create or replace procedure insertWink (pwinker number, pWinkedPerson number)
as
  --insert a tuple in the table Winkperson
       BEGIN
         insert into winkPerson (winker,winkedPerson)
         values(pwinker,pWinkedPerson);

        Exception
         WHEN INVALID_NUMBER THEN
              DBMS_OUTPUT.PUT_LINE ('Wink ID error ');
         WHEN OTHERS THEN
              DBMS_OUTPUT.PUT_LINE ('Unexpected error');
              RAISE;
         commit;

       END;
