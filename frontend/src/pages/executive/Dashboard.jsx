import DepartmentPerformance from '@/components/executive/dashboard/Departments'
import ExecutiveDashboardMetricsCards from '@/components/executive/dashboard/MetricsCards'
import ExecutiveMonthlyCollectionsChart from '@/components/executive/dashboard/MonthlyCollections'
import React from 'react'

const ExecutiveDashboard = () => {
  return (
    <div>
      <ExecutiveDashboardMetricsCards/>
      <div className='mt-6'>
        <ExecutiveMonthlyCollectionsChart/>
      </div>
      <div>
        <DepartmentPerformance/>
      </div>
    </div>
  )
}

export default ExecutiveDashboard