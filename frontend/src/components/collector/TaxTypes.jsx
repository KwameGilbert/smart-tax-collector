import React from 'react'
import TaxTypeList from './TaxTypesList'
import VerticalBarChart from './VerticalBarChart'

const TaxTypes = () => {
  return (
    <div className='bg-white p-6 rounded shadow flex-2'>
      <TaxTypeList/>
      <VerticalBarChart/>
    </div>
  )
}

export default TaxTypes
