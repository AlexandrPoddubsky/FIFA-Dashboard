

------------------------------------------------------------------------
create or replace trigger beforeInsert_team
       before insert
       on Team for each row
begin
     INSERT INTO Logbook(LogbookID,Userconected,Schedule,Date_Time,Tablename,Action,Descrip)
     VALUES (LogbookID_seq.Nextval,'ADMINF',user,sysdate,'TEAM','Insert','Inserting new TEAM');
end;

------------------------------------------------------------------------------
create or replace trigger beforeInsert_player
       before insert
       on player for each row
begin
     INSERT INTO Logbook(LogbookID,Userconected,Schedule,Date_Time,Tablename,Action,Descrip)
     VALUES (LogbookID_seq.Nextval,'ADMINF',user,sysdate,'Player','Insert','Inserting new Player');
end;
------------------------------------------------------------------------------
create or replace trigger beforeInsert_game
       before insert
       on game for each row
begin
     INSERT INTO Logbook(LogbookID,Userconected,Schedule,Date_Time,Tablename,Action,Descrip)
     VALUES (LogbookID_seq.Nextval,'ADMINF',user,sysdate,'Game','Insert','Inserting new Game');
end;
------------------------------------------------------------------------------
create or replace trigger beforeInsert_playerbyteam
       before insert
       on playerbyteam for each row
begin
     INSERT INTO Logbook(LogbookID,Userconected,Schedule,Date_Time,Tablename,Action,Descrip)
     VALUES (LogbookID_seq.Nextval,'ADMINF',user,sysdate,'playerbyteam','Insert','Inserting Player by Team');
end;
------------------------------------------------------------------------------
create or replace trigger beforeInsert_stadium
       before insert
       on stadiumcatalog for each row
begin
     INSERT INTO Logbook(LogbookID,Userconected,Schedule,Date_Time,Tablename,Action,Descrip)
     VALUES (LogbookID_seq.Nextval,'ADMINF',user,sysdate,'stadiumcatalog','Insert','Inserting  a new stadium');
end;
------------------------------------------------------------------------------

create or replace trigger beforeInsert_td
       before insert
       on tdcatalog for each row
begin
     INSERT INTO Logbook(LogbookID,Userconected,Schedule,Date_Time,Tablename,Action,Descrip)
     VALUES (LogbookID_seq.Nextval,'ADMINF',user,sysdate,'tdcatalog','Insert','Inserting  a new TD');
end;
------------------------------------------------------------------------------







create or replace trigger beforeInsert_team
       before insert of teamName on Team for each row
BEGIN
  IF INSERTING THEN
    INSERT INTO bitacora(bitacoraid,username,date_time,action,descrip)
    VALUES (bitacoraID_seq.Nextval,USER,date,'Insert','Inserting new Event' ||
    --' new key: ' || :new.key);
  ELSIF DELETING THEN
    INSERT INTO bitacora(bitacoraid,username,date_time,action,descrip)
    VALUES (bitacoraID_seq.Nextval,USER,date,'Delete','Deleting new Event' ||
 
  END IF;
END;
------------------------------------------------------------------------------
------------------------------------------------------------------------------






