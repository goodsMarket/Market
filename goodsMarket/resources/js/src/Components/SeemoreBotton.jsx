import React from "react";
import styled, { css } from "styled-components";


const StyledButton = styled.button`
    border-radius: 44px;
    font-size: 1.1rem;
    font-weight: 600;
    color: #ffffff;
    width: 90px;
    height: 40px;
    background-color: #98E3FB;
    border: 3px solid #82E1FF;

    &:hover {
        background-color: #39B0D6;
        border: 3px solid #39B0D6;
        transition: 0.2s;
        box-shadow: rgba(50, 50, 93, 0.25) 0px 6px 12px -2px, rgba(0, 0, 0, 0.3) 0px 3px 7px -3px;
    }

    ${(props) =>
        props.primary &&
        css`
        `}
    `;

function SeemoreBotton({ children, ...props }) {
    return <StyledButton {...props}>{children}</StyledButton>;
}


export default SeemoreBotton;