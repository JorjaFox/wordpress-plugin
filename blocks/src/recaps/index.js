//  Import CSS.
import './style.scss';
import './editor.scss';

const { __ } = wp.i18n;
const { Fragment, Component } = wp.element;
const { createBlock, registerBlockType } = wp.blocks;
const { RichText, PlainText, InspectorControls } = wp.blockEditor;
const { PanelBody, ToggleControl, SelectControl, TextControl } = wp.components;

// Display Stars
function DisplayStars( { value } ) {

    let color1;
    let color2;
    let color3;
    let color4;
    let color5;

    switch( value ) {
        case '0':
            color1 = 'grey-star';
            color2 = 'grey-star';
            color3 = 'grey-star';
            color4 = 'grey-star';
            color5 = 'grey-star';
            break;
        case '1':
            color1 = 'gold-star';
            color2 = 'grey-star';
            color3 = 'grey-star';
            color4 = 'grey-star';
            color5 = 'grey-star';
            break;
        case '2':
            color1 = 'gold-star';
            color2 = 'gold-star';
            color3 = 'grey-star';
            color4 = 'grey-star';
            color5 = 'grey-star';
            break;
        case '3':
            color1 = 'gold-star';
            color2 = 'gold-star';
            color3 = 'gold-star';
            color4 = 'grey-star';
            color5 = 'grey-star';
            break;
        case '4':
            color1 = 'gold-star';
            color2 = 'gold-star';
            color3 = 'gold-star';
            color4 = 'gold-star';
            color5 = 'grey-star';
            break;
        case '5':
            color1 = 'gold-star';
            color2 = 'gold-star';
            color3 = 'gold-star';
            color4 = 'gold-star';
            color5 = 'gold-star';
            break;
        default:
            color1 = 'red-star';
            color2 = 'red-star';
            color3 = 'red-star';
            color4 = 'red-star';
            color5 = 'red-star';
    }

    return (
        <Fragment>
        <svg version="1.1" id={ `${color1}` } xmlns="http://www.w3.org/2000/svg" viewBox="0 0 475.075 475.075"><g><path d="M475.075,186.573c0-7.043-5.328-11.42-15.992-13.135L315.766,152.6L251.529,22.694c-3.614-7.804-8.281-11.704-13.99-11.704 c-5.708,0-10.372,3.9-13.989,11.704L159.31,152.6L15.986,173.438C5.33,175.153,0,179.53,0,186.573c0,3.999,2.38,8.567,7.139,13.706 l103.924,101.068L86.51,444.096c-0.381,2.666-0.57,4.575-0.57,5.712c0,3.997,0.998,7.374,2.996,10.136 c1.997,2.766,4.993,4.142,8.992,4.142c3.428,0,7.233-1.137,11.42-3.423l128.188-67.386l128.194,67.379 c4,2.286,7.806,3.43,11.416,3.43c7.812,0,11.714-4.75,11.714-14.271c0-2.471-0.096-4.374-0.287-5.716l-24.551-142.744 l103.634-101.069C472.604,195.33,475.075,190.76,475.075,186.573z M324.619,288.5l20.551,120.2l-107.634-56.821L129.614,408.7 l20.843-120.2l-87.365-84.799l120.484-17.7l53.959-109.064l53.957,109.064l120.494,17.7L324.619,288.5z"/></g></svg>
        <svg version="1.1" id={ `${color2}` } xmlns="http://www.w3.org/2000/svg" viewBox="0 0 475.075 475.075"><g><path d="M475.075,186.573c0-7.043-5.328-11.42-15.992-13.135L315.766,152.6L251.529,22.694c-3.614-7.804-8.281-11.704-13.99-11.704 c-5.708,0-10.372,3.9-13.989,11.704L159.31,152.6L15.986,173.438C5.33,175.153,0,179.53,0,186.573c0,3.999,2.38,8.567,7.139,13.706 l103.924,101.068L86.51,444.096c-0.381,2.666-0.57,4.575-0.57,5.712c0,3.997,0.998,7.374,2.996,10.136 c1.997,2.766,4.993,4.142,8.992,4.142c3.428,0,7.233-1.137,11.42-3.423l128.188-67.386l128.194,67.379 c4,2.286,7.806,3.43,11.416,3.43c7.812,0,11.714-4.75,11.714-14.271c0-2.471-0.096-4.374-0.287-5.716l-24.551-142.744 l103.634-101.069C472.604,195.33,475.075,190.76,475.075,186.573z M324.619,288.5l20.551,120.2l-107.634-56.821L129.614,408.7 l20.843-120.2l-87.365-84.799l120.484-17.7l53.959-109.064l53.957,109.064l120.494,17.7L324.619,288.5z"/></g></svg>
        <svg version="1.1" id={ `${color3}` } xmlns="http://www.w3.org/2000/svg" viewBox="0 0 475.075 475.075"><g><path d="M475.075,186.573c0-7.043-5.328-11.42-15.992-13.135L315.766,152.6L251.529,22.694c-3.614-7.804-8.281-11.704-13.99-11.704 c-5.708,0-10.372,3.9-13.989,11.704L159.31,152.6L15.986,173.438C5.33,175.153,0,179.53,0,186.573c0,3.999,2.38,8.567,7.139,13.706 l103.924,101.068L86.51,444.096c-0.381,2.666-0.57,4.575-0.57,5.712c0,3.997,0.998,7.374,2.996,10.136 c1.997,2.766,4.993,4.142,8.992,4.142c3.428,0,7.233-1.137,11.42-3.423l128.188-67.386l128.194,67.379 c4,2.286,7.806,3.43,11.416,3.43c7.812,0,11.714-4.75,11.714-14.271c0-2.471-0.096-4.374-0.287-5.716l-24.551-142.744 l103.634-101.069C472.604,195.33,475.075,190.76,475.075,186.573z M324.619,288.5l20.551,120.2l-107.634-56.821L129.614,408.7 l20.843-120.2l-87.365-84.799l120.484-17.7l53.959-109.064l53.957,109.064l120.494,17.7L324.619,288.5z"/></g></svg>
        <svg version="1.1" id={ `${color4}` } xmlns="http://www.w3.org/2000/svg" viewBox="0 0 475.075 475.075"><g><path d="M475.075,186.573c0-7.043-5.328-11.42-15.992-13.135L315.766,152.6L251.529,22.694c-3.614-7.804-8.281-11.704-13.99-11.704 c-5.708,0-10.372,3.9-13.989,11.704L159.31,152.6L15.986,173.438C5.33,175.153,0,179.53,0,186.573c0,3.999,2.38,8.567,7.139,13.706 l103.924,101.068L86.51,444.096c-0.381,2.666-0.57,4.575-0.57,5.712c0,3.997,0.998,7.374,2.996,10.136 c1.997,2.766,4.993,4.142,8.992,4.142c3.428,0,7.233-1.137,11.42-3.423l128.188-67.386l128.194,67.379 c4,2.286,7.806,3.43,11.416,3.43c7.812,0,11.714-4.75,11.714-14.271c0-2.471-0.096-4.374-0.287-5.716l-24.551-142.744 l103.634-101.069C472.604,195.33,475.075,190.76,475.075,186.573z M324.619,288.5l20.551,120.2l-107.634-56.821L129.614,408.7 l20.843-120.2l-87.365-84.799l120.484-17.7l53.959-109.064l53.957,109.064l120.494,17.7L324.619,288.5z"/></g></svg>
        <svg version="1.1" id={ `${color5}` } xmlns="http://www.w3.org/2000/svg" viewBox="0 0 475.075 475.075"><g><path d="M475.075,186.573c0-7.043-5.328-11.42-15.992-13.135L315.766,152.6L251.529,22.694c-3.614-7.804-8.281-11.704-13.99-11.704 c-5.708,0-10.372,3.9-13.989,11.704L159.31,152.6L15.986,173.438C5.33,175.153,0,179.53,0,186.573c0,3.999,2.38,8.567,7.139,13.706 l103.924,101.068L86.51,444.096c-0.381,2.666-0.57,4.575-0.57,5.712c0,3.997,0.998,7.374,2.996,10.136 c1.997,2.766,4.993,4.142,8.992,4.142c3.428,0,7.233-1.137,11.42-3.423l128.188-67.386l128.194,67.379 c4,2.286,7.806,3.43,11.416,3.43c7.812,0,11.714-4.75,11.714-14.271c0-2.471-0.096-4.374-0.287-5.716l-24.551-142.744 l103.634-101.069C472.604,195.33,475.075,190.76,475.075,186.573z M324.619,288.5l20.551,120.2l-107.634-56.821L129.614,408.7 l20.843-120.2l-87.365-84.799l120.484-17.7l53.959-109.064l53.957,109.064l120.494,17.7L324.619,288.5z"/></g></svg>
        </Fragment>
    );
}

// Display Recap
function DisplayRecap( { link } ) {
    if ( link ) {
        return (
            <a href={ `${ link }` } class="btn btn-primary">Full Recap</a>
        );
    }
}

// Display Gallery
function DisplayGallery( { link, count } ) {
    if ( link && count ) {
        return (
            <a href={ link } class="btn btn-primary">Screenshots ({ count } images)</a>
        );
    }

    if ( link && ! count ) {
        return (
            <a href={ link } class="btn btn-primary">Screenshots</a>
        );
    }
}

registerBlockType( 'flfblocks/recap', {
	apiVersion: 2,
	title: __( 'Recap' ),
	icon: <svg aria-hidden="true" data-prefix="far" data-icon="star-exclamation" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" class="svg-inline--fa fa-star-exclamation fa-w-18 fa-3x"><path fill="currentColor" d="M252.5 184.6c-.4-4.6 3.3-8.6 8-8.6h55.1c4.7 0 8.3 4 8 8.6l-6.8 88c-.3 4.2-3.8 7.4-8 7.4h-41.5c-4.2 0-7.7-3.2-8-7.4l-6.8-88zM288 296c-22.1 0-40 17.9-40 40s17.9 40 40 40 40-17.9 40-40-17.9-40-40-40zm257.9-70L440.1 329l25 145.5c4.5 26.2-23.1 46-46.4 33.7L288 439.6l-130.7 68.7c-23.4 12.3-50.9-7.6-46.4-33.7l25-145.5L30.1 226c-19-18.5-8.5-50.8 17.7-54.6L194 150.2l65.3-132.4c11.8-23.8 45.7-23.7 57.4 0L382 150.2l146.1 21.2c26.2 3.8 36.7 36.1 17.8 54.6zm-56.8-11.7l-139-20.2-62.1-126L225.8 194l-139 20.2 100.6 98-23.7 138.4L288 385.3l124.3 65.4-23.7-138.4 100.5-98z" class=""></path></svg>,
	category: 'flfblocks',
	keywords: [
		__( 'recap' ),
		__( 'review' ),
	],
	customClassName: false,
	className: true,
	attributes: {
		summary: {
			type: 'string',
		},
		stars: {
			type: 'string',
			default: '3',
		},
		recaplink: {
			type: 'string',
			default: 'https://jorjafox.net/library/',
		},
		gallerylink: {
			type: 'string',
		},
		gallerycount: {
			type: 'string',
		},
	},

	edit: props => {
		const { attributes: { placeholder },
			 className, setAttributes,  } = props;
		const { summary, stars, recaplink, gallerylink, gallerycount } = props.attributes;

		return(
			<Fragment>
				<InspectorControls>
					<PanelBody title={ 'Recap Block Settings' }>
						<SelectControl
							label={ 'Stars' }
							value={ stars }
							options={ [
								{ label: 'Stars ... (5 is best, 0 is mentioned only)', value: null },
								{ label: '0', value: '0' },
								{ label: '1', value: '1' },
								{ label: '2', value: '2' },
								{ label: '3', value: '3' },
								{ label: '4', value: '4' },
								{ label: '5', value: '5' },
							] }
							onChange={ ( value ) => props.setAttributes( { stars: value } ) }
						/>
						<TextControl
							label={ 'Recap Link' }
							help={ 'Link to full recap.' }
							onChange={ ( recaplink ) => setAttributes( { recaplink } ) }
							value={ recaplink }
						/>
						<TextControl
							label={ 'Gallery Link' }
							help={ 'Link to full recap.' }
							onChange={ ( gallerylink ) => setAttributes( { gallerylink } ) }
							value={ gallerylink }
						/>
						<TextControl
							label={ 'Gallery Count' }
							help={ 'Number of items in the gallery' }
							onChange={ ( gallerycount ) => setAttributes( { gallerycount } ) }
							value={ gallerycount }
						/>
					</PanelBody>
				</InspectorControls>
				<div className={ `${ className } flf-recap card w-75` }>
					<div class="card-body">
						<div class="flf-rating"><DisplayStars value={ stars }/></div>
						<RichText
							tagName='p'
							class='card-text'
							value={ summary }
							placeholder={ 'Summary (could have been better...)' }
							onChange={ ( summary ) => setAttributes( { summary } ) }
						/>
						<a
							href={ recaplink }
							class="btn btn-primary"
						>
							Full Recap
						</a>&nbsp;
						<a
							href={ gallerylink }
							class="btn btn-primary"
						>
							Gallery ( { gallerycount } images)
						</a>
					</div>
				</div>
			</Fragment>
		);
	},

	save: props => {
		const { attributes: { className }, setAttributes } = props;
		const { summary, stars, recaplink, gallerylink, gallerycount } = props.attributes;

		return (
			<Fragment>
			<div className={ `${ className } flf-recap card w-75` }>
				<div class="card-body">
					<div class="flf-rating"><DisplayStars value={ stars }/></div>
					<RichText.Content
						tagName='p'
						value={ summary }
						class='card-text'
					/>
					<DisplayRecap link={ recaplink } />&nbsp;
                    <DisplayGallery link={ gallerylink } count={ gallerycount } />
				</div>
			</div>
			</Fragment>
		);
	},
} );
