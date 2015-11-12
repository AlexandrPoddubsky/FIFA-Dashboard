begin
DBMS_Scheduler.create_job(

    job_name => 'Insert_Employee05',
    job_type => 'PLSQL_BLOCK',
    job_action =>'begin insert_Employee(''juan'',''Bautista'',''jbautista888@gmail.com'',999999,sysdate,700,2,2,to_date(''17/06/1972'',''DD/MM/YYYY'')); end;',
    start_Date => systimestamp,
    repeat_interval =>'freq=secondly',
    end_date => null,
    enabled => true,
    comments =>'Mi primer job');
end;    

begin
-- Test statements here
DBMS_SCHEDULER.DROP_JOB('Insert_Employee05', --job_name 
FALSE --force
);
--si está corriendo 
/*DBMS_SCHEDULER.STOP_JOB('A01', --job_name 
FALSE --force
)
; */
end;
