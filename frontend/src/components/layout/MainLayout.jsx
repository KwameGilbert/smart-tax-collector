import React from 'react'
import { Outlet } from "react-router-dom";
import FinanceSidebar from './Sidebar'
import { useState } from 'react'
import FinanceMobileNavbar from './MobileNavbar';
import FinanceHeader from './Header';

const FinanceMainLayout = () => {
  const [showLabels, setShowLabels] = useState(true);

  return (
    <div className='flex h-screen bg-gray-100 transition-transform duration-300 transform'>
      <FinanceSidebar showLabels={showLabels}/>

      <div className='flex flex-col flex-grow'>
        {/* mobile navigation */}
        <div className='md:hidden'>
          <FinanceMobileNavbar/>
        </div>

        <div className='flex-1 flex flex-col overflow-hidden'>
          {/* header */}
          <FinanceHeader setShowLabels={setShowLabels} showLabels={showLabels}/>

          <main className="flex-1 overflow-y-auto md:p-2 lg:p-4">
            {/* Main content */}
            <Outlet />
          </main>
        </div>
      </div>
    </div>
  )
}

export default FinanceMainLayout
