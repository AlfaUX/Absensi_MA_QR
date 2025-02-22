<?php

namespace App\Controllers;

class Dashboard extends BaseController
{
    protected $dashboardModel;
    
    public function __construct()
    {
        $this->dashboardModel = new \App\Models\DashboardModel();
    }

    public function index()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to(base_url('pages/admin_login'));
        }

        $data = [
            'title' => 'Dashboard',
            'studentCount' => $this->dashboardModel->getStudentCount(),
            'adminCount' => $this->dashboardModel->getAdminCount(),
            'todayAttendance' => $this->dashboardModel->getTodayAttendance(),
            'weeklyAttendance' => $this->dashboardModel->getWeeklyAttendance(),
            'classAttendance' => $this->dashboardModel->getClassAttendance()
        ];

        // Kirim data ke view
        return view('pages/dashboard', $data);
    }
}
