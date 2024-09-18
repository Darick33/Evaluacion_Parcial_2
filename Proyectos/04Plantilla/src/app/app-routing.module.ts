// angular import
import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';

// Project import
import { AdminComponent } from './theme/layouts/admin-layout/admin-layout.component';
import { GuestComponent } from './theme/layouts/guest/guest.component';
import { usuariosGuardGuard } from './Guards/usuarios-guard.guard';

const routes: Routes = [
  {
    path: '', //url
    component: AdminComponent,
    children: [
      {
        path: '',
        redirectTo: '/dashboard/default',
        pathMatch: 'full'
      },
      {
        path: 'dashboard/default',
        loadComponent: () => import('./demo/default/dashboard/dashboard.component').then((c) => c.DefaultComponent),
      },
      
      {
        path: 'turistas',
        loadComponent: () => import('./turistas/turistas.component').then((m) => m.TuristaComponent),
      },
      {
        path: 'nuevoturista',
        loadComponent: () => import('./turistas/nuevocliente/nuevoturista.component').then((m) => m.NuevoTuristaComponent),
      },
      {
        path: 'editarturista/:id',
        loadComponent: () => import('./turistas/nuevocliente/nuevoturista.component').then((m) => m.NuevoTuristaComponent),
      },
      {
        path: 'destino',
        loadComponent: () => import('./destino/destino.component').then((m) => m.DestinoComponent)
      },
      {
        path: 'nuevodestino',
        loadComponent: () => import('./destino/nuevocliente/nuevodestino.component').then((m) => m.NuevoDestinoComponent),
      },
      {
        path: 'editardestino/:id',
        loadComponent: () => import('./destino/nuevocliente/nuevodestino.component').then((m) => m.NuevoDestinoComponent)
      },
      {
        path: 'reserva',
        loadComponent: () => import('./reserva/reserva.component').then((m) => m.ReservaComponent)
      },
      {
        path: 'nuevareserva',
        loadComponent: () => import('./reserva/nuevocliente/nuevareserva.component').then((m) => m.NuevaReservaComponent),
      },
      {
        path: 'editarreserva/:id',
        loadComponent: () => import('./reserva/nuevocliente/nuevareserva.component').then((m) => m.NuevaReservaComponent)
      },
     
    ]
  },
  {
    path: '',
    component: GuestComponent,
    children: [
      {
        path: 'login',
        loadComponent: () => import('./demo/authentication/login/login.component')
      },
      {
        path: 'login/:id',
        loadComponent: () => import('./demo/authentication/login/login.component')
      },
      {
        path: 'register',
        loadComponent: () => import('./demo/authentication/register/register.component')
      }
    ]
  }
];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule {}
