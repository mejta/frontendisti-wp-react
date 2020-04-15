import React, { useState } from 'react';
import { createPortal } from 'react-dom';
import PT from 'prop-types';
import { connect } from 'react-redux';
import { __ } from '@wordpress/i18n';
import styles from './ExamplePortalApp.module.scss';
import { getAppName, setAppName } from '../store/app';

const ExamplePortalApp = ({ name, setAppName }) => {

  const [newAppName, setNewAppName] = useState(name);

  const handleSetNewAppName = (event) => {
    setNewAppName(event.target.value);
  };

  const handleSubmit = () => {
    setAppName(newAppName);
  };

  return (
    <div className={styles.main}>
      <h1>
        {name}
      </h1>
      <p>
        <input value={newAppName} onChange={handleSetNewAppName} />
        <button type="button" onClick={handleSubmit}>
          {__('Change', 'wpreact')}
        </button>
      </p>
    </div>
  );
};

ExamplePortalApp.propTypes = {
  name: PT.string,
  setAppName: PT.func,
};

const mapStateToProps = (state) => ({
  name: getAppName(state),
});

const mapDispatchToProps = {
  setAppName,
};

const ConnectedExamplePortalApp = connect(mapStateToProps, mapDispatchToProps)(ExamplePortalApp);

// We will render this component on another place of the website than in the root of the React Application.
// See: https://reactjs.org/docs/portals.html
export default (props) => {
  const target = document.querySelector('.entry-content');

  if (target) {
    return createPortal(<ConnectedExamplePortalApp {...props} />, target);
  } else {
    return null;
  }
};
