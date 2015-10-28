--secuencia para manejo de id de continente

CREATE SEQUENCE continentId_seq
  MINVALUE 0
  MAXVALUE 999999999999999999999999999
  START WITH 0
  INCREMENT BY 1
  CACHE 20;
---------------------------------------------------  
--secuencia para manejo de id de city

CREATE SEQUENCE cityId_seq
  MINVALUE 0
  MAXVALUE 999999999999999999999999999
  START WITH 1
  INCREMENT BY 1
  CACHE 20;
  
---------------------------------------------------  
  --secuencia para manejo de id de eventos

CREATE SEQUENCE eventId_seq
  MINVALUE 0
  MAXVALUE 999999999999999999999999999
  START WITH 0
  INCREMENT BY 1
  CACHE 20;
  
---------------------------------------------------  
--secuencia para manejo de id de eventcatalog

CREATE SEQUENCE eventCatalogId_seq
  MINVALUE 0
  MAXVALUE 999999999999999999999999999
  START WITH 0
  INCREMENT BY 1
  CACHE 20;
---------------------------------------------------  
--secuencia para manejo de id de juegos

CREATE SEQUENCE gameId_seq
  MINVALUE 0
  MAXVALUE 999999999999999999999999999
  START WITH 0
  INCREMENT BY 1
  CACHE 20;
  
---------------------------------------------------  
--secuencia para manejo de id de grupos

CREATE SEQUENCE groupId_seq
  MINVALUE 0
  MAXVALUE 999999999999999999999999999
  START WITH 0
  INCREMENT BY 1
  CACHE 20;
---------------------------------------------------  
--secuencia para manejo de id de alineaciones

CREATE SEQUENCE lineupId_seq
  MINVALUE 0
  MAXVALUE 999999999999999999999999999
  START WITH 0
  INCREMENT BY 1
  CACHE 20;
---------------------------------------------------  
--secuencia para manejo de id de estadios

CREATE SEQUENCE stadiumId_seq
  MINVALUE 0
  MAXVALUE 999999999999999999999999999
  START WITH 0
  INCREMENT BY 1
  CACHE 20;
---------------------------------------------------  
--secuencia para manejo de id de technical director

CREATE SEQUENCE tdId_seq
  MINVALUE 0
  MAXVALUE 999999999999999999999999999
  START WITH 0
  INCREMENT BY 1
  CACHE 20;
---------------------------------------------------  
--secuencia para manejo de id de equipos

CREATE SEQUENCE teamId_seq
  MINVALUE 0
  MAXVALUE 999999999999999999999999999
  START WITH 0
  INCREMENT BY 1
  CACHE 20;
---------------------------------------------------  

---------------------------------------------------  
--secuencia para manejo de id de STATISTIC

CREATE SEQUENCE statisticId_seq
  MINVALUE 0
  MAXVALUE 999999999999999999999999999
  START WITH 0
  INCREMENT BY 1
  CACHE 20;
---------------------------------------------------  
--secuencia para manejo de id de STATISTIC

CREATE SEQUENCE adminId_seq
  MINVALUE 0
  MAXVALUE 999999999999999999999999999
  START WITH 1
  INCREMENT BY 1
  CACHE 20;
---------------------------------------------------  
