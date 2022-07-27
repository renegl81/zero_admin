import {
  mdiAccountCircle,
  mdiMonitor,
  mdiAccount,
  mdiGithub,
  mdiLock,
  mdiAlertCircle,
  mdiMonitorShimmer,
  mdiSquareEditOutline,
  mdiTable,
  mdiViewList,
  mdiTelevisionGuide,
  mdiResponsive,
  mdiPalette
} from '@mdi/js'

export default [
 /* 'General',*/
  [
    {
        id: 1,
      to: '/',
      icon: mdiMonitor,
      label: 'Dashboard'
    },
      {
          id: 2,
          to: '/users',
          label: 'Users',
          icon: mdiAccount
      }
  ],
    /*  'Examples',
      [
        {
          to: '/tables',
          label: 'Tables',
          icon: mdiTable
        },
        {
          to: '/forms',
          label: 'Forms',
          icon: mdiSquareEditOutline
        },
        {
          to: '/ui',
          label: 'UI',
          icon: mdiTelevisionGuide
        },
        {
          to: '/responsive',
          label: 'Responsive',
          icon: mdiResponsive
        },
        {
          to: '/',
          label: 'Styles',
          icon: mdiPalette
        },
        {
          to: '/profile',
          label: 'Profile',
          icon: mdiAccountCircle
        },
        {
          to: '/login',
          label: 'Login',
          icon: mdiLock
        },
        {
          to: '/error',
          label: 'Error',
          icon: mdiAlertCircle
        },
        {
          label: 'Dropdown',
          icon: mdiViewList,
          menu: [
            {
              label: 'Item One'
            },
            {
              label: 'Item Two'
            }
          ]
        }
  ]*/
]
