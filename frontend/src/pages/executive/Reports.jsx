import ExecutiveMonthlyCollectionsChart from '@/components/executive/dashboard/MonthlyCollections'
import StatsCards from '@/components/executive/reports/StatCards'
import PaymentCollectionsMethods from '@/components/financial/charts/PaymentCollectionsMethods'
import React from 'react'

const ExecutiveReports = () => {
  return (
    <div>
        <div>
          <h1 className="text-2xl font-bold mb-1">Reports & Analytics</h1>
          <p className="text-gray-600">View and analyze your reports here.</p>
        </div>

        <div className='my-4'>
          <StatsCards/>
        </div>

        {/* Charts */}
        <div className='my-4 grid grid-cols-1 lg:grid-cols-2 gap-4'>
          <div>
            <ExecutiveMonthlyCollectionsChart/>
          </div>
          <div>
            <PaymentCollectionsMethods/>
          </div>
        </div>
    </div>
  )
}

export default ExecutiveReports