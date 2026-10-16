<?php

namespace App\Http\Controllers;

use App\Services\DashboardService;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;
use Throwable;

class DashboardController extends Controller
{
    protected DashboardService $service;

    public function __construct(DashboardService $service)
    {
        $this->service = $service;
    }

    public function index(): View|JsonResponse
    {
        try {
            $data = $this->service->getDashboardData();

            if (request()->expectsJson()) {
                return response()->json([
                    'success' => true,
                    'data' => $data,
                ]);
            }

            return view(
                'example.content.dashboard_super_admin',
                $data
            );

        } catch (Throwable $e) {
            \Log::error('Gagal mengambil data dashboard', [
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
            ]);

            if (request()->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Gagal mengambil data dashboard.',
                ], 500);
            }

            abort(500, 'Gagal mengambil data dashboard.');
        }
    }
}