<?php
class ForeignVisitReportService
{
    private $repo;

    public function __construct(ForeignVisitReportRepository $repo)
    {
        $this->repo = $repo;
    }

    // Search/filter visits
    public function searchVisits(array $filters, string $startDate = '', string $endDate = ''): array
    {
        return $this->repo->getFilteredVisits($filters, $startDate, $endDate);
    }

    // Get visit counts for maximum/minimum
    public function getVisitCounts(string $visitType, string $startDate = '', string $endDate = ''): array
    {
        $order = ($visitType === 'maximum') ? 'DESC' : 'ASC';
        return $this->repo->getVisitCounts($order, $startDate, $endDate);
    }

    // Get dropdown lists
    public function getDropdownValues(): array
    {
        return $this->repo->getDropdownValues();
    }
}