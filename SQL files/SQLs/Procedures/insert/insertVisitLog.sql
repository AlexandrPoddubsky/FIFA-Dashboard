create or replace procedure insertVisitlog (logDate date, pVisitor number, pVisitedPerson number)
as
       BEGIN
         insert into visitLog (LogNumber,logDate,Visitor,Visitedperson)
         values(VisitLogNumber_seq.nextval,logDate,pVisitor,pVisitedPerson);

        Exception
         WHEN INVALID_NUMBER THEN
              DBMS_OUTPUT.PUT_LINE ('Visit Log error ');
         WHEN OTHERS THEN
              DBMS_OUTPUT.PUT_LINE ('Unexpected error');
              RAISE;
         commit;

       END;
