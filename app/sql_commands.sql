/* ACTIVITES MODIFY FOR TREE BEHAVIOR */
alter table activities add column lft int(10) unsigned DEFAULT NULL after sub_category_of;
alter table activities add column rhgt int(10) unsigned DEFAULT NULL after lft;
alter table activities modify column lft int(10) unsigned DEFAULT NULL;
alter table activities change sub_category_of parent_id int(10) unsigned DEFAULT NULL;
