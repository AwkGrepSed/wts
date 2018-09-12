-- build me some test data
--update articles  set created_at = '2018-03-30 17:00:00' where id = 1 ;
--update articles  set created_at = '2018-03-30 17:00:00' where id = 2 ;
--update articles  set created_at = '2018-04-30 17:00:00' where id = 3 ;
--update articles  set created_at = '2018-04-30 17:00:00' where id = 4 ;
--update articles  set created_at = '2018-01-30 17:00:00' where id = 5 ;
--update articles  set created_at = '2018-01-30 17:00:00' where id = 6 ;
--update articles  set created_at = '2018-06-30 17:00:00' where id = 7 ;
--update articles  set created_at = '2018-06-30 17:00:00' where id = 8 ;
--update articles  set created_at = '2018-07-30 17:00:00' where id = 9 ;


select 
 to_char(created_at, 'YYYY') as year
,to_char(created_at, 'MM')  as month
,count(*) as recdcntr
from articles
group by
 to_char(created_at, 'YYYY')
,to_char(created_at, 'MM')
order by
 to_char(created_at, 'YYYY') desc
,to_char(created_at, 'MM') desc
;

-- this worked
--select
-- substr(to_char(created_at,'YYYYMMDD-HH24MISS'),1,4) as year
--,substr(to_char(created_at,'YYYYMMDD-HH24MISS'),5,2) as month
--,count(*) as recdcntr
--from articles
--group by
-- substr(to_char(created_at,'YYYYMMDD-HH24MISS'),1,4)
--,substr(to_char(created_at,'YYYYMMDD-HH24MISS'),5,2)
--order by
-- substr(to_char(created_at,'YYYYMMDD-HH24MISS'),1,4)
--,substr(to_char(created_at,'YYYYMMDD-HH24MISS'),5,2)
--;

-- does not work
--select 
-- date_part('year', created_at) as year
--,date_part('month', created_at) as month
--,count(*) as records
--from articles
--groupby
-- date_part('year', created_at)
--,date_part('month', created_at)
--orderby
-- date_part('year', created_at)
--,date_part('month', created_at)
--;

-- does not work
--select
-- substr(to_char(vhcalldt,'YYYYMMDD-HH24MISS'),1,4) as yyyy
-- year(created_at) as yyyy
--,monthname(created_at) as mmm
--,count(*) as records
-- from articles
-- groupby year(created_at)
--,monthname(created_at)
-- orderby year(created_at)
--,monthname(created_at)
--;
