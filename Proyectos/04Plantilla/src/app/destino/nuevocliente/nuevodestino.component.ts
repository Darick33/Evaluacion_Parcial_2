import { Component, OnInit } from '@angular/core';
import { AbstractControl, FormControl, FormGroup, ReactiveFormsModule, ValidationErrors, Validators } from '@angular/forms';
import { CommonModule } from '@angular/common';
import Swal from 'sweetalert2';
import { ActivatedRoute, Router } from '@angular/router';
import { DestinoService } from 'src/app/Services/destino.service';
import { IDestino } from 'src/app/Interfaces/destino.interface';
@Component({
  selector: 'app-nuevocliente',
  standalone: true,
  imports: [ReactiveFormsModule, CommonModule],
  templateUrl: './nuevocliente.component.html',
})
export class NuevoDestinoComponent implements OnInit {
  frm_Destino = new FormGroup({
    //idClientes: new FormControl(),
    nombre: new FormControl('', Validators.required),
    pais: new FormControl('', Validators.required),
    descripcion: new FormControl('', Validators.required),
    costo: new FormControl('', [Validators.required, ]),
  });
  destino_id = 0;
  titulo = 'Nuevo Destino';
  constructor(
    private destinoService: DestinoService,
    private navegacion: Router,
    private ruta: ActivatedRoute
  ) {}

  ngOnInit(): void {
    this.destino_id = parseInt(this.ruta.snapshot.paramMap.get('id'));
    console.log(this.destino_id);
    if (this.destino_id > 0) {
      this.destinoService.uno(this.destino_id.toString()).subscribe((destino) => {
        this.frm_Destino.controls['nombre'].setValue(destino.nombre);
        this.frm_Destino.controls['pais'].setValue(destino.pais);
        this.frm_Destino.controls['descripcion'].setValue(destino.descripcion);
        this.frm_Destino.controls['costo'].setValue(destino.costo);
        this.titulo = 'Editar Destino';
      });
    }
  }

  grabar() {
    let destino: IDestino = {
      destino_id: this.destino_id.toString(),
      nombre: this.frm_Destino.controls['nombre'].value,
      pais: this.frm_Destino.controls['pais'].value,
      descripcion: this.frm_Destino.controls['descripcion'].value,
      costo: this.frm_Destino.controls['costo'].value,
    };

   
        if (this.destino_id > 0) {
          this.destinoService.actualizar(destino).subscribe((res: any) => {
            Swal.fire({
              title: 'destino',
              text: 'Destino Actualizado correctamente',
              icon: 'success'
            });
            this.navegacion.navigate(['/destino']);
          });
        } else {
          this.destinoService.insertar(destino).subscribe((res: any) => {
            Swal.fire({
              title: 'destino',
              text: 'Destino Ingresado correctamente',
              icon: 'success'
            });
            this.navegacion.navigate(['/destino']);
          });
        }
      }
    
    }