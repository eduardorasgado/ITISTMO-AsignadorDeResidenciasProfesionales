import React, { Component } from 'react'
import axios from 'axios';

class SinodaliasTable extends Component {
	render() {
		return (
				<div>
					<div>
						<h2 className="text-justify">Lista de Sinodalías creadas</h2>
					</div>
					<table className="table">
						<thead className="thead-dark">
					    <tr>
					      <th scope="col">#</th>
					      <th scope="col">First</th>
					      <th scope="col">Last</th>
					      <th scope="col">Handle</th>
					    </tr>
					  </thead>
					  <tbody>
					    <tr>
					      <th scope="row">1</th>
					      <td>Mark</td>
					      <td>Otto</td>
					      <td>@mdo</td>
					    </tr>
					    <tr>
					      <th scope="row">2</th>
					      <td>Jacob</td>
					      <td>Thornton</td>
					      <td>@fat</td>
					    </tr>
					    <tr>
					      <th scope="row">3</th>
					      <td>Larry</td>
					      <td>the Bird</td>
					      <td>@twitter</td>
					    </tr>
					  </tbody>
					</table>
				</div>
			)
	}
}

export default SinodaliasTable