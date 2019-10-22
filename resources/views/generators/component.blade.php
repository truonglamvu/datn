'use strict';
import React, { Component } from 'react';
import { connect } from 'react-redux';
import { {{$ClassName}}Create,{{$ClassName}}Update,{{$ClassName}}Delete } from '../{{$ClassName}}Action.jsx';
import { translate } from 'react-i18next';
import { Link } from 'react-router';

class {{$ClassName}} extends Component
{
	constructor(props) {
		super(props);
	}
	
	/**
     *
     * Event Change Function Logic
     *
     */

	_onChange(e) {
        e.preventDefault();
    }

	render() {
		document.title = "{{$ClassName}}";
		const __ = this.props.t;

		return(
			<div id="{{str_slug($ClassName)}}">

			</div>
		)
	}
}

export default translate()(connect()({{$ClassName}}));