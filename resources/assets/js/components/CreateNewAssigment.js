import React, { Component } from 'react'

class CreateNewAssigment extends Component {
	constructor (props) {
		super(props)

	}
	render(){
		return(
				<div>
					<h2>Asignación de nueva Sinodalía</h2>
					<form>
						<div class="form-group">
							<label for="profesor">Asignado</label>
							<select className="">
							</select>
						</div>
					</form>
				</div>
			)
	}
}

export default CreateNewAssigment