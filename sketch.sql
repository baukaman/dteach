create table teacher_online (TEACHER_ID, NAME, SUBJECT, LEVEL, CITY, LHS);
create table live_lesson (ID, NAME, TEACHER_ID, STUDENT_ID, START_DATE, END_DATE); //uq (teacher_id), uq(student_id)
create table teacher_accept (TEACHER_ID, START_DATE, END_DATE); //unique constraint teacher_id
create table teacher_page (ID, TEACHER_ID, PAGE_ID);


--1,2,3,4,5,6,7,8

--todaysoft.kz/api/lesson.request?subject=physics&level=8&rating=5&user_id=3&city=Almaty
/*
   Query: refreshAcceptQueue:
     delete from teacher_accept where end_date < now();
   
   Query: getFreeOnline:
   select * from teacher_online t
            where not exists (select ID from live_lessons where TEACHER_ID = t.ID)
              and not exists (select TEACHER_ID from teacher_accept where TEACHER_ID = t.ID)
            and t.SUBJECT = &subject and t.level = &level;

	Query: getFirstPage:
	select top(1) * from teacher_page where teacher_id = &teacher_id;
*/
teacherDao.refreshAcceptQueue();
List<Teacher> teachers = teacherDao.getFreeOnline();

if(teachers.size() < 1) {
     return NO_TEACHER_AVAILABLE;
} else {
	List<Teacher> cConstraint = teachers.stream().filter(t => t.city != &city).toList();

	if(cConstraint.size() < 1) {	
	  cConstraint = teachers; 
	}

	Arrays.sort(cConstraint, new LHSComparator());
	lhsConstraint = cConstratint.stream().filter(c.lhs != cConstraint.get(0)).toList();

	--need this optimization ???
	--random_shuffle(lhsConstraint); 

	List<Teacher> rConstraint = lhsConstraint.stream().filter(t => t.rating() >= &rating).toList();

	if(rConstraint.size() > 0) {
	   Arrays.sort(rConstraint, new RatingAcsendingSort());
	} else {
	   rConstraint = lhsConstraint;
	   Arrays.sort(rConstraint, new RatingDescendingSort());
	}

	Teacher t = rConstraint.get(0);
	teacherDao.addAcceptQueue(t);
	return teacherDao.getPageFirst(t);
}

--todaysoft.kz/api/connect.teacher?teacher_id=148&page_id=uuid
teacherDao.connectPage(&teacherId, &uuid);

--todaysoft.kz/api/disconnect?teacher_id=148&page_id=uuid
teacherDao.disconnectPage(&teacherId, &uuid);








