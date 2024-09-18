import { Component, OnInit } from '@angular/core';
import { RouterLink } from '@angular/router';
import { SharedModule } from 'src/app/theme/shared/shared.module';
import { ClientesService } from '../Services/clientes.service';
import Swal from 'sweetalert2';
import { IReserva } from '../Interfaces/reserva.interface';
import { ReservaService } from '../Services/reserva.service';
@Component({
  selector: 'app-clientes',
  standalone: true,
  imports: [RouterLink, SharedModule],
  templateUrl: './clientes.component.html',
})
export class ReservaComponent {
  listareservas: IReserva[] = [];
  constructor(private reservaService: ReservaService) {}

  ngOnInit() {
    this.cargatabla();
  }
  cargatabla() {
    this.reservaService.todos().subscribe((data) => {
      console.log(data);
      this.listareservas = data;
    });
  }

  abrirReporte(id) {
    let ruta = 'http://localhost/Sexto/gias2/Sexto/Proyectos/03MVC/reports/reserva.report.php?reserva_id='+id;
    window.open(ruta);
  }
  eliminar(reserva_id) {
    Swal.fire({
      title: 'Clientes',
      text: 'Esta seguro que desea eliminar el cliente!',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#d33',
      cancelButtonColor: '#3085d6',
      confirmButtonText: 'Emliminar Cliente'
    }).then((result) => {
      if (result.isConfirmed) {
        this.reservaService.eliminar(reserva_id).subscribe((data) => {
          Swal.fire('Clientes', 'El cliente ha sido eliminado.', 'success');
          this.cargatabla();
        });
      }
    });
  }
}
