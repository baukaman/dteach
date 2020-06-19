<?php


namespace App\Service;


use App\Repository\OnlineLessonRepository;

class OnlineLessonService
{
    /**
     * @var OnlineLessonRepository
     */
    private $repository;


    /**
     * OnlineLessonService constructor.
     */
    public function __construct(OnlineLessonRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getOnlineTeacher(array $request)
    {
        $users = $this->repository->onlineTeachers($request['subject'], $request['level']);

        if($users->count() < 1) {
            throw new \Exception('no.teachers.available');
        } else {
            $cConstraint = $users->filter(function ($value, $key) use ($request) {
                return $value->city != $request['city'];
            });

            if ($cConstraint->count() < 1)
                $cConstraint = $users;

            $lhsConstraint = $cConstraint->sortBy(function ($a) {
                return $a->lhs;
            });

            $baseLhs = $lhsConstraint->values()->get(0)->lhs;
            $lhsConstraint = $lhsConstraint->filter(function ($teacher) use ($baseLhs) {
                return $teacher->lhs == $baseLhs;
            });

            $baseRating = $request['rating'] ?? 0.0;
            $rConstraint = $lhsConstraint->filter(function ($t) use ($baseRating) {
                return $t->rating >= $baseRating;
            });

            if ($rConstraint->count() > 0) {
                $rConstraint = $rConstraint->sortBy(function ($t) {
                    return $t->rating;
                });
            } else {
                $rConstraint = $lhsConstraint->sortByDesc(function ($t) {
                    return $t->rating;
                });
            }

            $teacherOnline = $rConstraint->values()->get(0);
            $this->repository->addAcceptQueue($teacherOnline);
            //$page = $this->repository->getTeacherPage($teacherOnline);
            return $teacherOnline;
        }
    }
}
