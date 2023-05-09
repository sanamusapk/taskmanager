<?php

namespace App\Helpers;

use App\Models\Task;
use App\Models\WeekTaskDay;
use Carbon\CarbonPeriod;
use Illuminate\Support\Facades\Auth;

const DAILY = 1; 
const WEEKLY = 2; 
const MONTHLY = 3; 
const YEARLY = 4; 
const ITERATION = 1; 
const DATES = 2; 

class TaskHelpers
{
    public function store($data)
    {
        $new_data = $this->arrangeData($data);
        $task = Task::create($new_data);
        if(count($data['weekly_days']) > 0)
            $this->storeWeeklyDays($data['weekly_days'],$task->id);
    }
    public function update($task_id,$status)
    {
        $task = Task::find($task_id);
        $task->update([
            'status' => $status 
        ]);
    }

    private function storeWeeklyDays($days,$task_id)
    {
        foreach($days as $day)
        {
            WeekTaskDay::create([
                'task_id' => $task_id,
                'day' => $day,
            ]);
        }
    }
    private function arrangeData($data)
    {
        return  [
            'name' => $data['name'],
            'type' => $data['type'],
            'day' => $data['day'],
            'month' => $data['month'],
            'nature' => $data['nature'],
            'iteration' => $data['iteration'],
            'start_date' => $data['start_date'],
            'end_date' => $data['end_date'],
            'description' => $data['description'],
            'user_id' => Auth::user()->id
        ];
    }
    public function todayTasks()
    {
        return Task::where('user_id',Auth::user()->id)->where(function ($query) {
            $query->where(function ($query) {
                $query->where('type',DAILY);
                $query->where(function ($query) {
                    $query->where(function ($query) {
                        $query->where('nature', DATES)->where('end_date', '>=', today());
                    })
                    ->orWhere(function ($query) {
                        $query->where('nature', ITERATION)->whereRaw('iteration >= timestampdiff(DAY,created_at,now())');
                    });
                });
            })
            ->orWhere(function ($query) {
                $query->where('type',WEEKLY);
                $query->where(function ($query) {
                    $query->whereHas('weekly', function ($query) {
                        $query->where('day', today()->dayOfWeek);
                    });
                    $query->where(function ($query) {
                        $query->where(function ($query) {
                            $query->where('nature', DATES)->where('end_date', '>=', today());
                        })
                        ->orWhere(function ($query) {
                            $query->where('nature', ITERATION)->whereRaw('iteration >= timestampdiff(WEEK,created_at,now())');
                        });
                    });
                });
            })
            ->orWhere(function ($query) {
                $query->where('type', MONTHLY)->where('day', today()->day);
                $query->where(function ($query) {
                    $query->where(function ($query) {
                        $query->where(function ($query) {
                            $query->where('nature', DATES)->where('end_date', '>=', today());
                        })
                        ->orWhere(function ($query) {
                            $query->where('nature', ITERATION)->whereRaw('iteration >= timestampdiff(MONTH,created_at,now())');
                        });
                    });
                });
            })
            ->orWhere(function ($query) {
                $query->where('type', YEARLY)->where('day', today()->day)->where('month', today()->month);
                $query->where(function ($query) {
                    $query->where(function ($query) {
                        $query->where(function ($query) {
                            $query->where('nature', DATES)->where('end_date', '>=', today());
                        })
                        ->orWhere(function ($query) {
                            $query->where('nature', ITERATION)->whereRaw('iteration >= timestampdiff(YEAR,created_at,now())');
                        });
                    });
                }); 
            });
        })->get();
                 
    }
    public function tommorrowTasks()
    {
        return Task::where('user_id',Auth::user()->id)->where(function ($query) {
            $query->where(function ($query) {
                $query->where('type',DAILY);
                $query->where(function ($query) {
                    $query->where(function ($query) {
                        $query->where('nature', DATES)->where('end_date', '>=', today()->addDay(1));
                    })
                    ->orWhere(function ($query) {
                        $query->where('nature', ITERATION)->whereRaw('iteration >= timestampdiff(DAY,created_at,now()+INTERVAL 1 DAY)');
                    });
                });
            })
            ->orWhere(function ($query) {
                $query->where('type',WEEKLY);
                $query->where(function ($query) {
                    $query->whereHas('weekly', function ($query) {
                        $query->where('day',  today()->addDay(1)->dayOfWeek);
                    });
                    $query->where(function ($query) {
                        $query->where(function ($query) {
                            $query->where('nature', DATES)->where('end_date', '>=',  today()->addDay(1));
                        })
                        ->orWhere(function ($query) {
                            $query->where('nature', ITERATION)->whereRaw('iteration >= timestampdiff(WEEK,created_at,now()+INTERVAL 1 DAY)');
                        });
                    });
                });
            })
            ->orWhere(function ($query) {
                $query->where('type', MONTHLY)->where('day',  today()->addDay(1)->day);
                $query->where(function ($query) {
                    $query->where(function ($query) {
                        $query->where(function ($query) {
                            $query->where('nature', DATES)->where('end_date', '>=',  today()->addDay(1));
                        })
                        ->orWhere(function ($query) {
                            $query->where('nature', ITERATION)->whereRaw('iteration >= timestampdiff(MONTH,created_at,now()+INTERVAL 1 DAY)');
                        });
                    });
                });
            })
            ->orWhere(function ($query) {
                $query->where('type', YEARLY)->where('day',  today()->addDay(1)->day)->where('month',  today()->addDay(1)->month);
                $query->where(function ($query) {
                    $query->where(function ($query) {
                        $query->where(function ($query) {
                            $query->where('nature', DATES)->where('end_date', '>=',  today()->addDay(1));
                        })
                        ->orWhere(function ($query) {
                            $query->where('nature', ITERATION)->whereRaw('iteration >= timestampdiff(YEAR,created_at,now()+INTERVAL 1 DAY)');
                        });
                    });
                }); 
            });
        })->get();
                 
    }
    public function nextWeekTasks()
    {
        $nextWeekDay = today()->addWeeks(1)->startOfWeek();
        $week_dates =  CarbonPeriod::create(clone $nextWeekDay, clone $nextWeekDay->endOfWeek())->toArray();
        $week_days = $week_months = [];
        foreach($week_dates as $week_date){
            $week_days[] = $week_date->day;
            if(!in_array($week_date->month, $week_months)){
                array_push($week_months, $week_date->month);
            }
        }
        return Task::where('user_id',Auth::user()->id)->where(function ($query) use ($week_days, $week_months) {
            $query->where(function ($query) {
                $query->where('type',DAILY);
                $query->where(function ($query) {
                    $query->where(function ($query) {
                        $query->where('nature', DATES)->whereDate('end_date', '>', today()->addWeeks(1)->endOfWeek());
                    })
                    ->orWhere(function ($query) {
                        $query->where('nature', ITERATION)->whereRaw('iteration >= timestampdiff(DAY,created_at, now()+INTERVAL 7 - weekday(now())DAY)');
                    });
                });
            })
            ->orWhere(function ($query) use ($week_days) {
                $query->where('type',WEEKLY);
                $query->where(function ($query) use ($week_days) {
                    $query->whereHas('weekly', function ($query)use ($week_days)  {
                        $query->whereIn('day', $week_days);
                    });
                    $query->where(function ($query) {
                        $query->where(function ($query) {
                            $query->where('nature', DATES)->whereDate('end_date', '>', today()->addWeeks(1)->endOfWeek());
                        })
                        ->orWhere(function ($query) {
                            $query->where('nature', ITERATION)->whereRaw('iteration >= timestampdiff(WEEK,created_at, now()+INTERVAL 7 - weekday(now())DAY)');
                        });
                    });
                });
            })
            ->orWhere(function ($query)  use ($week_days) {
                $query->where('type', MONTHLY)->whereIn('day', $week_days);
                $query->where(function ($query) {
                    $query->where(function ($query) {
                        $query->where(function ($query) {
                            $query->where('nature', DATES)->whereDate('end_date', '>', today()->addWeeks(1)->endOfWeek());
                        })
                        ->orWhere(function ($query) {
                            $query->where('nature', ITERATION)->whereRaw('iteration >= timestampdiff(MONTH,created_at, now()+INTERVAL 7 - weekday(now())DAY)');
                        });
                    });
                });
            })
            ->orWhere(function ($query)  use ($week_days, $week_months){
                $query->where('type', YEARLY)->whereIn('day', $week_days)->whereIn('month', $week_months);
                $query->where(function ($query) {
                    $query->where(function ($query) {
                        $query->where(function ($query) {
                            $query->where('nature', DATES)->whereDate('end_date', '>', today()->addWeeks(1)->endOfWeek());
                        })
                        ->orWhere(function ($query) {
                            $query->where('nature', ITERATION)->whereRaw('iteration >= timestampdiff(YEAR,created_at, now()+INTERVAL 7 - weekday(now())DAY)');
                        });
                    });
                }); 
            });
        })->get();        
    }
    public function secondNextTasks()
    {
        $secondWeekDay = today()->addWeeks(2)->startOfWeek();
        $week_dates =  CarbonPeriod::create(clone $secondWeekDay, clone $secondWeekDay->endOfWeek())->toArray();
        $week_days = $week_months = [];
        foreach($week_dates as $week_date){
            $week_days[] = $week_date->day;
            if(!in_array($week_date->month, $week_months)){
                array_push($week_months, $week_date->month);
            }
        }
        return Task::where('user_id',Auth::user()->id)->where(function ($query) use ($week_days, $week_months) {
            $query->where(function ($query) {
                $query->where('type',DAILY);
                $query->where(function ($query) {
                    $query->where(function ($query) {
                        $query->where('nature', DATES)->whereDate('end_date', '>', today()->addWeeks(2)->endOfWeek());
                    })
                    ->orWhere(function ($query) {
                        $query->where('nature', ITERATION)->whereRaw('iteration >= timestampdiff(DAY,created_at, now()+INTERVAL 14 - weekday(now())DAY)');
                    });
                });
            })
            ->orWhere(function ($query) use ($week_days) {
                $query->where('type',WEEKLY);
                $query->where(function ($query) use ($week_days) {
                    $query->whereHas('weekly', function ($query)use ($week_days)  {
                        $query->whereIn('day', $week_days);
                    });
                    $query->where(function ($query) {
                        $query->where(function ($query) {
                            $query->where('nature', DATES)->whereDate('end_date', '>', today()->addWeeks(2)->endOfWeek());
                        })
                        ->orWhere(function ($query) {
                            $query->where('nature', ITERATION)->whereRaw('iteration >= timestampdiff(WEEK,created_at, now()+INTERVAL 14 - weekday(now())DAY)');
                        });
                    });
                });
            })
            ->orWhere(function ($query)  use ($week_days) {
                $query->where('type', MONTHLY)->whereIn('day', $week_days);
                $query->where(function ($query) {
                    $query->where(function ($query) {
                        $query->where(function ($query) {
                            $query->where('nature', DATES)->whereDate('end_date', '>', today()->addWeeks(2)->endOfWeek());
                        })
                        ->orWhere(function ($query) {
                            $query->where('nature', ITERATION)->whereRaw('iteration >= timestampdiff(MONTH,created_at, now()+INTERVAL 14 - weekday(now())DAY)');
                        });
                    });
                });
            })
            ->orWhere(function ($query)  use ($week_days, $week_months){
                $query->where('type', YEARLY)->whereIn('day', $week_days)->whereIn('month', $week_months);
                $query->where(function ($query) {
                    $query->where(function ($query) {
                        $query->where(function ($query) {
                            $query->where('nature', DATES)->whereDate('end_date', '>', today()->addWeeks(2)->endOfWeek());
                        })
                        ->orWhere(function ($query) {
                            $query->where('nature', ITERATION)->whereRaw('iteration >= timestampdiff(YEAR,created_at, now()+INTERVAL 14 - weekday(now())DAY)');
                        });
                    });
                }); 
            });
        })->get();    

    }
    public function futureTasks()
    {
        $secondWeekDay = today()->addWeeks(3)->startOfWeek();
        $week_dates =  CarbonPeriod::create(clone $secondWeekDay, clone $secondWeekDay->endOfWeek())->toArray();
        $week_days = $week_months = [];
        foreach($week_dates as $week_date){
            $week_days[] = $week_date->day;
            if(!in_array($week_date->month, $week_months)){
                array_push($week_months, $week_date->month);
            }
        }
        return Task::where('user_id',Auth::user()->id)->where(function ($query) use ($week_days, $week_months) {
            $query->where(function ($query) {
                $query->where('type',DAILY);
                $query->where(function ($query) {
                    $query->where(function ($query) {
                        $query->where('nature', DATES)->whereDate('end_date', '>', today()->addWeeks(3)->endOfWeek());
                    })
                    ->orWhere(function ($query) {
                        $query->where('nature', ITERATION)->whereRaw('iteration >= timestampdiff(DAY,created_at, now()+INTERVAL 21 - weekday(now())DAY)');
                    });
                });
            })
            ->orWhere(function ($query) use ($week_days) {
                $query->where('type',WEEKLY);
                $query->where(function ($query) use ($week_days) {
                    $query->whereHas('weekly', function ($query)use ($week_days)  {
                        $query->whereIn('day', $week_days);
                    });
                    $query->where(function ($query) {
                        $query->where(function ($query) {
                            $query->where('nature', DATES)->whereDate('end_date', '>', today()->addWeeks(3)->endOfWeek());
                        })
                        ->orWhere(function ($query) {
                            $query->where('nature', ITERATION)->whereRaw('iteration >= timestampdiff(WEEK,created_at, now()+INTERVAL 21 - weekday(now())DAY)');
                        });
                    });
                });
            })
            ->orWhere(function ($query)  use ($week_days) {
                $query->where('type', MONTHLY)->whereIn('day', $week_days);
                $query->where(function ($query) {
                    $query->where(function ($query) {
                        $query->where(function ($query) {
                            $query->where('nature', DATES)->whereDate('end_date', '>', today()->addWeeks(3)->endOfWeek());
                        })
                        ->orWhere(function ($query) {
                            $query->where('nature', ITERATION)->whereRaw('iteration >= timestampdiff(MONTH,created_at, now()+INTERVAL 21 - weekday(now())DAY)');
                        });
                    });
                });
            })
            ->orWhere(function ($query)  use ($week_days, $week_months){
                $query->where('type', YEARLY)->whereIn('day', $week_days)->whereIn('month', $week_months);
                $query->where(function ($query) {
                    $query->where(function ($query) {
                        $query->where(function ($query) {
                            $query->where('nature', DATES)->whereDate('end_date', '>', today()->addWeeks(3)->endOfWeek());
                        })
                        ->orWhere(function ($query) {
                            $query->where('nature', ITERATION)->whereRaw('iteration >= timestampdiff(YEAR,created_at, now()+INTERVAL 21 - weekday(now())DAY)');
                        });
                    });
                }); 
            });
        })->get();    

    }
}
