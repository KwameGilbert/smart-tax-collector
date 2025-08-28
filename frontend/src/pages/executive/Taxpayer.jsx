import TaxpayersDashboardStats from '@/components/executive/taxpayers/StatCards'
import TaxpayerCharts from '@/components/executive/taxpayers/TaxpayersChart'
import React from 'react'

const Taxpayer = () => {
  return (
    <div>
        <h1 className='text-2xl font-bold'>Taxpayer Reports</h1>
        <p className='text-gray-600'>Overview of taxpayer statistics and reports.</p>
        <div>
            <TaxpayersDashboardStats/>
        </div>
        <div>
            <TaxpayerCharts/>
        </div>
    </div>
  )
}

export default Taxpayer