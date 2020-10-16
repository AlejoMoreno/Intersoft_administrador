import React from 'react';

class EmpresasComponent extends React.Component{

    constructor(props) {
        super(props);
        this.handleClick = this.handleClick.bind(this);
    }

    handleClick() {
        console.log('Se hizo click');
    }

    render() {
        return <section class="page-section" id="empresas">
        <div class="container">
            <h2 class="text-center mt-0">Nuestras Empresas</h2>
            <hr class="divider my-4" />
            <div class="row">
                <div class="col-lg-3 col-md-6 text-center">
                  <div class="card">
                    <div class="card-header">Agroseeds</div>
                    <div class="card-body">
                      <p class="card-text">Selecciona si deseas ver facturas de esta empresa</p>
                      <a href="javascript:;" onClick="irDownloadPage(1)" class="btn btn-primary">Buscar</a>
                    </div>
                  </div>
                </div>
                <div class="col-lg-3 col-md-6 text-center">
                  <div class="card">
                    <div class="card-header">Vitagro</div>
                    <div class="card-body">
                      <p class="card-text">Selecciona si deseas ver facturas de esta empresa</p>
                      <a href="javascript:;" onClick="irDownloadPage(2)" class="btn btn-primary">Buscar</a>
                    </div>
                  </div>
                </div>
            </div>
        </div>
      </section>;
    }
}