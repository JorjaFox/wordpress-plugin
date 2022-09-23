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
        <svg id={ `${color1}` } viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="m22.17 9h-7.07l-2.22-7.346c-.126-.391-.481-.654-.881-.654s-.755.263-.881.654l-2.311 7.346h-6.941c-1.013 0-1.013 1-.631 1.382l5.68 4.254-2.3 7.104c-.127.393.006.826.329 1.072.324.247.764.25 1.092.009l5.962-4.386 5.962 4.386c.162.12.351.179.54.179.194 0 .388-.063.552-.187.323-.246.456-.679.329-1.072l-2.3-7.104 5.68-4.254c.384-.383.384-1.383-.591-1.383z" /></svg>
        <svg id={ `${color2}` } viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="m22.17 9h-7.07l-2.22-7.346c-.126-.391-.481-.654-.881-.654s-.755.263-.881.654l-2.311 7.346h-6.941c-1.013 0-1.013 1-.631 1.382l5.68 4.254-2.3 7.104c-.127.393.006.826.329 1.072.324.247.764.25 1.092.009l5.962-4.386 5.962 4.386c.162.12.351.179.54.179.194 0 .388-.063.552-.187.323-.246.456-.679.329-1.072l-2.3-7.104 5.68-4.254c.384-.383.384-1.383-.591-1.383z" /></svg>
        <svg id={ `${color3}` } viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="m22.17 9h-7.07l-2.22-7.346c-.126-.391-.481-.654-.881-.654s-.755.263-.881.654l-2.311 7.346h-6.941c-1.013 0-1.013 1-.631 1.382l5.68 4.254-2.3 7.104c-.127.393.006.826.329 1.072.324.247.764.25 1.092.009l5.962-4.386 5.962 4.386c.162.12.351.179.54.179.194 0 .388-.063.552-.187.323-.246.456-.679.329-1.072l-2.3-7.104 5.68-4.254c.384-.383.384-1.383-.591-1.383z" /></svg>
        <svg id={ `${color4}` } viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="m22.17 9h-7.07l-2.22-7.346c-.126-.391-.481-.654-.881-.654s-.755.263-.881.654l-2.311 7.346h-6.941c-1.013 0-1.013 1-.631 1.382l5.68 4.254-2.3 7.104c-.127.393.006.826.329 1.072.324.247.764.25 1.092.009l5.962-4.386 5.962 4.386c.162.12.351.179.54.179.194 0 .388-.063.552-.187.323-.246.456-.679.329-1.072l-2.3-7.104 5.68-4.254c.384-.383.384-1.383-.591-1.383z" /></svg>
        <svg id={ `${color5}` } viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="m22.17 9h-7.07l-2.22-7.346c-.126-.391-.481-.654-.881-.654s-.755.263-.881.654l-2.311 7.346h-6.941c-1.013 0-1.013 1-.631 1.382l5.68 4.254-2.3 7.104c-.127.393.006.826.329 1.072.324.247.764.25 1.092.009l5.962-4.386 5.962 4.386c.162.12.351.179.54.179.194 0 .388-.063.552-.187.323-.246.456-.679.329-1.072l-2.3-7.104 5.68-4.254c.384-.383.384-1.383-.591-1.383z" /></svg>
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
